import type { APIContext } from "astro";
import { db as astro_db, AuthRequests } from 'astro:db';

import { eq, or } from "drizzle-orm/expressions";
import { user } from "~/db/schema.ts";

import { OAuth2RequestError } from "arctic";
import { generateId } from "lucia";

import { db } from "~/db/db.ts";
import { lucia } from "~/auth/auth.ts";

import { github } from "~/auth/github.ts";
import { google } from "~/auth/google.ts";

export async function GET(context: APIContext): Promise<Response> {
  const code = context.url.searchParams.get("code");
  const state = context.url.searchParams.get("state");
  const storedStates = await astro_db.select().from(AuthRequests).where(
    eq(AuthRequests.columns.state, state)
  );

  const storedState = storedStates?.[0];
  if (!code || !(storedState && state && state === storedState.state)) {
    return new Response(null, {
      status: 400
    });
  }

  try {
    const tokens = await github.validateAuthorizationCode(code);
    const githubUserResponse = await fetch("https://api.github.com/user", {
      headers: {
        Authorization: `Bearer ${tokens.accessToken}`
      }
    });
    const githubUser: GitHubUser = await githubUserResponse.json();
    const existingUsers = await db.select().from(user).where(
      eq(user.id, githubUser.id)
    );

    const existingUser = existingUsers?.[0];
    if (existingUser) {
      const session = await lucia.createSession(existingUser.id, {});
      const sessionCookie = lucia.createSessionCookie(session.id);
      context.cookies.set(sessionCookie.name, sessionCookie.value, sessionCookie.attributes);
      return context.redirect("/");
    }

    const userId = generateId(15);
    await db.insert(user).values({
      id: userId,
      githubId: githubUser.id,
      username: githubUser.login,
      email: githubUser.email
    });

    const session = await lucia.createSession(userId, {});
    const sessionCookie = lucia.createSessionCookie(session.id);
    context.cookies.set(sessionCookie.name, sessionCookie.value, sessionCookie.attributes);
    return context.redirect("/");
  } catch (e) {
    if (e instanceof OAuth2RequestError && e.message === "bad_verification_code") {
      // invalid code
      return new Response(null, {
        status: 400
      });
    }
    return new Response(null, {
      status: 500
    });
  }
}

interface GitHubUser {
  id: string;
  login: string;
  email: string;
}