import { eq, or } from "drizzle-orm/expressions";

import { verify } from "~/utils/passsword.ts";
import { lucia } from "~/auth/auth.ts";
import { user } from "~/db/schema.ts";
import { db } from "~/db/db.ts";

import { Result } from "@oxi/result";
import { z } from "zod";

export const schema = z.object({
  // username must be between 4 ~ 31 characters, and only consists of lowercase letters, 0-9, -, and _
  // keep in mind some database (e.g. mysql) are case insensitive
  username: z.string().regex(/^[a-z0-9_-]+$/).min(3).max(31, { message: "Invalid username" }),
  email: z.string().email({ message: "Invalid email address" }),
  password: z.string().min(6).max(255, { message: "Invalid password" }),
});

export async function handler(props: z.infer<typeof schema>) {
  const { username, email, password } = props;
  const { success, error } = schema.safeParse(props);
  if (!success) return Result.Err(error);

  try {
    const users = await db.select({
      id: user.id,
      hash: user.hash
    }).from(user).where(
      or(
        eq(user.username, username),
        eq(user.email, email)
      )
    );

    const userData = users?.[0];
    if (userData) {
      const verified = await verify(userData.hash, password);
      if (verified) {
        const session = await lucia.createSession(userData.id, {});
        const sessionCookie = lucia.createSessionCookie(session.id);
        return Result.Ok(sessionCookie);
      }
    }

    return Result.Err("Incorrect username, email and/or password");
  } catch (e) {
    return Result.Err("An unknown error occurred");
  }
};