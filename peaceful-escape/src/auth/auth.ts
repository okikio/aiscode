import { DrizzlePostgreSQLAdapter } from "@lucia-auth/adapter-drizzle";
import { Lucia } from "lucia";

import { user, session } from "~/db/schema.ts";
import { db } from "~/db/db.ts";

import { MODE } from "~/env.ts"; 

export const adapter = new DrizzlePostgreSQLAdapter( db, session, user );
export const lucia = new Lucia(adapter, {
  sessionCookie: {
    attributes: {
      // Set to `true` when using HTTPS
      secure: MODE === "production"
    }
  },
  getUserAttributes(attributes) {
    return {
      // Attributes has the type of DatabaseUserAttributes
      username: attributes.username,
      githubId: attributes.github_id,
    };
  }
});

// const session = await lucia.createSession(userId, {});
// await lucia.validateSession(session.id);

declare module "lucia" {
  interface Register {
    Lucia: typeof lucia;
    DatabaseUserAttributes: DatabaseUserAttributes
  }
}

interface DatabaseUserAttributes {
  username: string;
  github_id: number;
}