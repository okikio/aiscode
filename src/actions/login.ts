import { eq, or } from "drizzle-orm/expressions";

import { verify } from "~/utils/passsword.ts";
import { lucia } from "~/auth/auth.ts";
import { user } from "~/db/schema.ts";
import { db } from "~/db/db.ts";

import { Result } from "@oxi/result";
import { z } from "zod";


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
  email: z.string().email({ message: "Invalid email address" }).optional(),
  /**
   * Password must be between 6 to 255 characters.
   */
  password: z.string().min(6).max(255, { message: "Invalid password" }),
}).refine(data => data.username || data.email, {
  message: "Either username or email must be present",
  path: ['username', 'email'],
});

/**
 * Handles the authentication request by validating the input properties, checking the database for the user, 
 * verifying the password, and creating a session if authentication is successful.
 * 
 * @param {z.infer<typeof schema>} props - The input properties containing username, email, and password.
 * @returns A Result object containing the session cookie on success or an error message on failure.
 * 
 * @example
 * const response = await handler({ username: "testuser", password: "password123" });
 * if (response.isOk()) {
 *   console.log(response.unwrap()); // Session cookie
 * } else {
 *   console.log(response.unwrapErr()); // Error message
 * }
 * 
 * @remarks
 * This function handles both username and email for user identification. It uses the Lucia authentication library to create sessions.
 */
export async function handler(props: z.infer<typeof schema>) {
  const { username, email, password } = props;

  // Validate the input properties using the schema
  const { success, error } = schema.safeParse(props);
  if (!success) return Result.Err(error);

  try {
    // Query the database for the user by username or email
    const users = await db.select({
      id: user.id,
      hash: user.hash
    }).from(user).where(
      or(
        eq(user.username, username!),
        eq(user.email, email!),
      )
    );

    const userData = users?.[0];
    if (userData) {
      // Verify the user's password
      if (userData.hash && await verify(userData.hash, password)) {
        // Create a session and session cookie if authentication is successful
        const session = await lucia.createSession(userData.id, {});
        const sessionCookie = lucia.createSessionCookie(session.id);
        return Result.Ok(sessionCookie);
      }

      // Returns an error about missing a password
      if (!userData.hash) return Result.Err("A password was never set for this account, was a login provider used?")

      // Return an error if the password is incorrect
      return Result.Err("Incorrect username, email and/or password");
    }

    // Return an error if the user doesn't exist
    return Result.Err("User doesn't exist");
  } catch (e) {
    // Return a generic error for any other issues
    return Result.Err("An unknown error occurred");
  }
}