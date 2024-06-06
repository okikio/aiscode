import type { GitHubTokens, GoogleTokens } from "arctic";
import type { PostgresError } from "postgres";

import { db as AstroDB, OAuthRequests, } from 'astro:db';

import { Result } from "@oxi/result";
import { z } from "zod";

import { generateUsernameFromEmail, generateRandomUsername } from "~/utils/username.ts";
import { oauthAccount, user } from "~/db/schema.ts";

import { OAuth2RequestError } from "arctic";
import { generateIdFromEntropySize } from "lucia";

import { and, eq } from "drizzle-orm/expressions";
import { lucia } from "~/auth/auth.ts";
import { db } from "~/db/db.ts";

import { github } from "~/auth/github.ts";
import { google } from "~/auth/google.ts";

import { google as googleapis } from "googleapis"; // Google APIs
import { Octokit } from "@octokit/rest"; // Octokit REST API

// Schema for validating the input properties with custom error messages
export const schema = z.object({
  code: z.string().min(1, { message: "Authorization code is required" }),
  state: z.string().min(1, { message: "State parameter is required" }),
  provider: z.enum(["google", "github"], { message: "Provider must be either 'google' or 'github'" }),
});

// Schema for validating provider user details with custom error messages
export const providerUserSchema = z.object({
  id: z.string().min(1, { message: "Provider user ID is required" })
    .transform((v) => typeof v === "number" && !isNaN(v) ? String(v) : v),
  username: z.string().min(1, { message: "Username is required" }),
  email: z.string().min(1, { message: "Email is required" }).email({ message: "Invalid email address" }),
});

/**
 * Handles OAuth authentication and user creation, linking the OAuth account.
 * 
 * @param {object} props - The input properties containing code, state, and provider.
 * @param {string} props.code - The authorization code.
 * @param {string} props.state - The state parameter to verify the request.
 * @param {string} props.provider - The OAuth provider (google or github).
 * @returns A Result object containing either the session cookie or an error.
 * 
 * @example
 * const result = await handler({ code: "auth_code", state: "random_state", provider: "google" });
 * if (result.isOk()) {
 *   const sessionCookie = result.unwrap();
 *   // Use the session cookie
 * } else {
 *   const error = result.unwrapErr();
 *   // Handle the error
 * }
 * 
 * @example
 * const result = await handler({ code: "auth_code", state: "random_state", provider: "github" });
 * if (result.isOk()) {
 *   const sessionCookie = result.unwrap();
 *   // Use the session cookie
 * } else {
 *   const error = result.unwrapErr();
 *   // Handle the error
 * }
 */
export async function handler(props: z.infer<typeof schema>) {
  const { code, state, provider } = props;

  // Validate the input properties using the schema
  const parseResult = schema.safeParse(props);
  if (!parseResult.success) {
    // Return an error result if validation fails
    return Result.Err(parseResult.error);
  }

  // Fetch the authentication request from the database
  const oauthRequests = await AstroDB.select().from(OAuthRequests).where(eq(OAuthRequests.state, state));
  const oauthRequest = oauthRequests?.[0];

  // Validate the state parameter
  if (!oauthRequest || state !== oauthRequest.state) {
    return Result.Err("Invalid state parameter");
  }

  try {
    let tokenResponse: GoogleTokens | GitHubTokens;
    let providerUser: z.infer<typeof providerUserSchema> | null = null;

    // Handle OAuth provider specific logic
    switch (provider) {
      case "google":
        // Validate Google authorization code and get token response
        tokenResponse = await google.validateAuthorizationCode(code, oauthRequest.codeVerifier);

        // Use Google APIs to fetch user information
        const oauth2Client = new googleapis.auth.OAuth2();
        oauth2Client.setCredentials({ access_token: tokenResponse.accessToken });

        const oauth2 = googleapis.oauth2({ version: "v2", auth: oauth2Client });
        const { data: googleUser } = await oauth2.userinfo.get();

        // Validate and parse provider user information
        providerUser = providerUserSchema.parse({
          id: googleUser.id,
          email: googleUser.email,
          username: googleUser.email ? 
            generateUsernameFromEmail(googleUser.email, 100_000) : 
            generateRandomUsername(),
        });
        break;

      case "github":
        // Validate GitHub authorization code and get token response
        tokenResponse = await github.validateAuthorizationCode(code);

        // Use Octokit to fetch GitHub user information
        const octokit = new Octokit({ auth: tokenResponse.accessToken });
        const { data: githubUser } = await octokit.rest.users.getAuthenticated();

        // Validate and parse provider user information
        providerUser = providerUserSchema.parse({
          id: githubUser.id,
          email: githubUser.email,
          username: githubUser.login ?? generateRandomUsername()
        });
        break;

      default:
        return Result.Err("OAuth provider specified doesn't exist");
    }

    // Ensure provider user information is available
    if (!providerUser) throw new Error(`Error validating ${provider} OAuth account`);

    // Check if the OAuth account already exists
    const existingOAuthAccounts = await db.select().from(oauthAccount).where(
      and(
        eq(oauthAccount.provider, provider),
        eq(oauthAccount.providerAccountId, providerUser.id),
      )
    );

    // If the OAuth account exists, create a session and return the session cookie
    const existingOAuth = existingOAuthAccounts?.[0];
    if (existingOAuth) {
      const session = await lucia.createSession(existingOAuth.userId, {});
      const sessionCookie = lucia.createSessionCookie(session.id);
      return Result.Ok(sessionCookie);
    }

    // Perform a transaction to create the user and link the OAuth account atomically
    const userId = generateIdFromEntropySize(15);
    await db.transaction(async (tr) => {
      const existingUsers = await tr.select().from(user).where(eq(user.email, providerUser.email));
      let userData = existingUsers[0];

      if (!userData) {
        // Insert the new user if not existing
        const userValues = await tr.insert(user).values({
          id: userId,
          username: providerUser.username,
          email: providerUser.email
        }).returning();
        userData = userValues[0]!;
      }

      // Link the OAuth account to the user
      await tr.insert(oauthAccount).values({
        userId: userData.id,
        provider: provider,
        providerAccountId: providerUser.id,
      });
    });

    // Create a session for the new user
    const session = await lucia.createSession(userId, {});
    const sessionCookie = lucia.createSessionCookie(session.id);
    return Result.Ok(sessionCookie);
  } catch (e) {
    // Handle known errors and return appropriate error messages
    if (e instanceof OAuth2RequestError && e.message === "bad_verification_code") {
      return Result.Err("Invalid verification code");
    }

    if ((e as PostgresError)?.code && /unique_violation/i.test((e as PostgresError).code)) {
      return Result.Err("Unique constraint violation");
    }

    return Result.Err("An unknown error occurred");
  } finally {
    // Clean up the authentication request
    await AstroDB.delete(OAuthRequests).where(eq(OAuthRequests.state, state));
  }
}
