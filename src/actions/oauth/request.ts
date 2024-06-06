import { db as AstroDB, OAuthRequests } from 'astro:db';

import { Result } from "@oxi/result";
import { z } from "zod";

import { generateCodeVerifier, generateState } from "arctic";
import { generateId } from "lucia";

import { github } from "~/auth/github.ts";
import { google } from "~/auth/google.ts";

// Schema for validating provider parameter with custom error messages
export const schema = z.object({
  provider: z.enum(["google", "github"], { message: "Provider must be either 'google' or 'github'" })
});

/**
 * Handles OAuth redirection by generating state and code verifier, then creating an authorization URL.
 * 
 * @param {object} props - The input properties containing provider.
 * @param {string} props.provider - The OAuth provider (google or github).
 * @returns A Result object containing either the redirection URL or an error message.
 * 
 * @example
 * const result = await handler({ provider: "google" });
 * if (result.isOk()) {
 *   const url = result.unwrap();
 *   // Redirect the user to the URL
 * } else {
 *   const error = result.unwrapErr();
 *   // Handle the error
 * }
 * 
 * @example
 * const result = await handler({ provider: "github" });
 * if (result.isOk()) {
 *   const url = result.unwrap();
 *   // Redirect the user to the URL
 * } else {
 *   const error = result.unwrapErr();
 *   // Handle the error
 * }
 */
export async function handler(props: z.infer<typeof schema>) {
  const { provider } = props;

  // Validate the provider parameter using the schema
  const parseResult = schema.safeParse({ provider });
  if (!parseResult.success) {
    // Return an error result if validation fails
    return Result.Err(parseResult.error);
  }

  // Generate state and code verifier for OAuth
  const state = generateState();
  const codeVerifier = generateCodeVerifier();

  let url: URL;
  try {
    // Handle provider-specific logic for creating the authorization URL
    switch (provider) {
      case "google":
        url = await google.createAuthorizationURL(state, codeVerifier, {
          scopes: ["profile", "email"]
        });
        url.searchParams.set("access_type", "offline");
        break;
      case "github":
        url = await github.createAuthorizationURL(state);
        url.searchParams.set("access_type", "offline");
        break;
      default:
        return Result.Err("OAuth provider specified doesn't exist");
    }

    // Insert the state and code verifier into the database
    await AstroDB.insert(OAuthRequests).values({
      id: generateId(16),
      state,
      codeVerifier,
      provider,
      createdAt: new Date()
    });

    // Return the URL as a success result
    return Result.Ok(url.toString());
  } catch (e) {
    // Handle unexpected errors and return an error result
    return Result.Err("An unknown error occurred");
  }
}
