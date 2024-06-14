import type { PostgresError } from "postgres";

import { generateEmailVerificationCode, sendVerificationCode } from "~/utils/verification-code.ts";
import { generateRandomUsername } from "~/utils/username.ts";
import { Result } from "@oxi/result";
import { z } from "zod";

import { eq } from "drizzle-orm/expressions";
import { lucia } from "~/auth/auth.ts";
import { user } from "~/db/schema.ts";
import { db } from "~/db/db.ts";

import { generateIdFromEntropySize } from "lucia";
import { hash } from "~/utils/passsword.ts";


// Define the validation schema for the input properties
export const schema = z.object({
  /**
   * Username must be between 4 to 31 characters, consisting of lowercase letters, 0-9, '-', and '_'.
   * Note: Some databases (e.g., MySQL) are case insensitive.
   */
  username: z.string().regex(/^[a-z0-9_-]+$/).min(3).max(31, { message: "Invalid username" }).optional(),
  /**
   * Email must be a valid email address.
   */
  email: z.string().email({ message: "Invalid email address" }),
  /**
   * Password must be between 6 to 255 characters.
   */
  password: z.string().min(6).max(255, { message: "Invalid password" }),

  /**
   * above_18 is a required boolean value that indicates whether the user is above 18 years old.
   */
  above_18: z.union([z.literal("18+"), z.boolean()])
    .transform(value => {
      if (value === "18+") return true;
      return value;
    })
    .refine(value => typeof value === 'boolean', {
      message: "above_18 must be a boolean value",
    }),
});

/**
 * Handles the user registration request by validating the input properties, checking if the email already exists,
 * hashing the password, and creating a new user and session if registration is successful.
 * 
 * @param {z.infer<typeof schema>} props - The input properties containing username, email, and password.
 * @returns A Result object containing the session cookie on success or an error message on failure.
 * 
 * @example
 * const response = await handler({ email: "test@example.com", password: "password123" });
 * if (response.isOk()) {
 *   console.log(response.unwrap()); // Session cookie
 * } else {
 *   console.log(response.unwrapErr()); // Error message
 * }
 * 
 * @remarks
 * This function ensures that the email is unique and generates a random username if one is not provided. It uses the Lucia authentication library to create sessions.
 */
export async function handler(props: z.infer<typeof schema>) {
  const { username, email, password } = props;

  // Validate the input properties using the schema
  const { success, error } = schema.safeParse(props);
  if (!success) return Result.Err(error);

  try {
    console.log({
      email: email
    })

    // Check if a user with the provided email already exists in the database
    const existingUsers = await db.select().from(user).where(eq(user.email, email));
    const existingUser = existingUsers[0];
    if (existingUser) {
      return Result.Err("Email already exists");
    }

    // Generate a unique ID for the new user
    const userId = generateIdFromEntropySize(16); // 16 characters long

    // Hash the user's password
    const passwordHash = await hash(password);

    // Insert the new user into the database
    await db.insert(user).values({
      id: userId,
      username: username ?? generateRandomUsername(), // Generate a random username if not provided
      hash: passwordHash,
      email: email,
      verified: null, // Verification status is initially null
    });

    const verificationCode = await generateEmailVerificationCode(userId, email);
    await sendVerificationCode(email, verificationCode)
      .catch(x => console.log(x));

    // Create a new session for the user
    const session = await lucia.createSession(userId, {});
    const sessionCookie = lucia.createSessionCookie(session.id);

    // Return the session cookie as the result
    return Result.Ok(sessionCookie);
  } catch (e) {
    // Handle unique constraint violations (e.g., username already used)
    if ((e as PostgresError)?.code && /unique_violation/i.test((e as PostgresError).code)) {
      return Result.Err("Username already used");
    }
    
    // Return a generic error for any other issues
    return Result.Err("An unknown error occurred");
  }
}