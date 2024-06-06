import type { APIContext } from "astro"; 
import { db, AuthRequests } from 'astro:db';

import { generateCodeVerifier, generateState } from "arctic";

import { github } from "~/auth/github.ts";
import { google } from "~/auth/google.ts";

import { generateId, generateIdFromEntropySize } from "lucia";

export const prerender = false;
export async function GET(context: APIContext): Promise<Response> {
  const providerName = context.params.provider;

  const state = generateState();
  const codeVerifier = generateCodeVerifier();

  let url: URL;
  switch (providerName) {
    case "google":
      url = await google.createAuthorizationURL(state, codeVerifier, {
        scopes: ["profile", "email"]
      })
      break;
    case "github":
      url = await github.createAuthorizationURL(state);
      break;
    default:
      return new Response(
        JSON.stringify({
          error: "OAuth provider specified doesn't exist"
        }), {
        status: 400,
        headers: { "Content-Type": "application/json" }
      });
  }

  // Insert the state and code verifier into the database
  await db.insert(AuthRequests).values({
    id: generateId(16),
    state,
    codeVerifier,
    provider: providerName,
    created_at: new Date()
  });

  // context.cookies.set(`${providerName}_oauth_state`, state, {
  //   path: "/",
  //   // Set to `true` when using HTTPS
  //   secure: MODE === "production",
  //   httpOnly: true,
  //   maxAge: 60 * 10,
  //   sameSite: "lax"
  // });

  return context.redirect(url.toString());
}