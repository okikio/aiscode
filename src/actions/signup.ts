import type { PostgresError } from "postgres";

import { Result } from "@oxi/result";
import { z } from "zod";

import { eq } from "drizzle-orm/expressions"
import { lucia } from "~/auth/auth.ts";
import { user } from "~/db/schema.ts";
import { db } from "~/db/db.ts";

import { generateId } from "lucia";
import { generateRandomUsername } from "~/utils/username.ts";
import { hash } from "~/utils/passsword.ts";

export const schema = z.object({
  // username must be between 4 ~ 31 characters, and only consists of lowercase letters, 0-9, -, and _
  // keep in mind some database (e.g. mysql) are case insensitive
  username: z.string().regex(/^[a-z0-9_-]+$/).min(3).max(31, { message: "Invalid username" }).optional(),
  email: z.string().email({ message: "Invalid email address" }),
  password: z.string().min(6).max(255, { message: "Invalid password" }),
});

export async function handler(props: z.infer<typeof schema>) {
  const { username, email, password } = props;
  const { success, error } = schema.safeParse(props);
  if (!success) return Result.Err(error);

  try {
    const existingUsers = await db.select().from(user).where(eq(user.email, email));
    const existingUser = existingUsers[0];
    if (existingUser) {
      return Result.Err("Email already exists");
    }

    const userId = generateId(16); // 16 characters long
    const passwordHash = await hash(password);

    await db.insert(user).values({
      id: userId,
      username: username ?? generateRandomUsername(),
      hash: passwordHash,
      email: email
    });

    const session = await lucia.createSession(userId, {});
    const sessionCookie = lucia.createSessionCookie(session.id);
    return Result.Ok(sessionCookie);
  } catch (e) {
    if ((e as PostgresError)?.code && /unique_violation/i.test((e as PostgresError).code)) {
      return Result.Err("Username already used");
    }
    
    return Result.Err("An unknown error occurred");
  }
};