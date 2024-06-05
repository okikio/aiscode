import { Result } from "@oxi/result";
import { z } from "zod";

import { lucia } from "~/auth/auth.ts";
import { user } from "~/db/schema.ts";
import { db } from "~/db/db.ts";

import { generateIdFromEntropySize } from "lucia";
import { hash } from "~/utils/passsword.ts";

import { PostgresError } from "postgres";
import { eq, or } from "drizzle-orm/expressions";

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
    const userId = generateIdFromEntropySize(16); // 16 characters long
    const passwordHash = await hash(password);

    // TODO: check if username is already used
    await db.insert(user).values({
      id: userId,
      username: username,
      hash: passwordHash,
      email: email
    });

    const savedHash = await db.select({
      id: user.id,
      hash: user.hash
    }).from(user).where(
      or(
        eq(user.username, username),
        eq(user.email, email)
      )
    )

    const session = await lucia.createSession(userId, {});
    const sessionCookie = lucia.createSessionCookie(session.id);
    return Result.Ok(sessionCookie);
  } catch (e) {
    if (e instanceof PostgresError && /unique_violation/i.test(e.code)) {
      return Result.Err("Username already used");
    }

    return Result.Err("An unknown error occurred");
  }
};