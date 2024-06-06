
import { verifyVerificationCode } from "~/utils/verification-code.ts";
import { eq, or } from "drizzle-orm/expressions";

import { user, verificationCode } from "~/db/schema.ts";
import { lucia } from "~/auth/auth.ts";
import { db } from "~/db/db.ts";

import { Result } from "@oxi/result";
import { z } from "zod";

// Define the validation schema for the input properties
export const schema = z.object({
  sessionId: z.string({ message: "Invalid session" }),
  code: z.string({ message: "Invalid code" }),
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
  const { sessionId, code } = props;

  // Validate the input properties using the schema
  const { success, error } = schema.safeParse(props);
  if (!success) return Result.Err(error);

  try {
    const { user: userData } = await lucia.validateSession(sessionId);
    if (!userData) return Result.Err("Invalid session");

    const validCode = await verifyVerificationCode(userData, code);
    if (!validCode) return Result.Err("Invalid code");

    await lucia.invalidateUserSessions(userData.id);

    // Update the user into the database
    await db.update(user)
      .set({ verified: new Date() })
      .where(eq(user.id, userData.id));

    // Create a new session for the user
    const session = await lucia.createSession(userData.id, {});
    const sessionCookie = lucia.createSessionCookie(session.id);

    // Return the session cookie as the result
    return Result.Ok(sessionCookie);
  } catch (e) {
    // Return a generic error for any other issues
    return Result.Err("An unknown error occurred");
  }
}