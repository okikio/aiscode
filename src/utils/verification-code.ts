import type { User } from "lucia";

import { generateRandomString, alphabet } from "oslo/crypto";
import { TimeSpan, createDate, isWithinExpirationDate } from "oslo";
import { eq } from "drizzle-orm/expressions";

import { verificationCode } from "~/db/schema.ts";
import { db } from "~/db/db.ts";

export async function generateEmailVerificationCode(userId: string, email: string): Promise<string> {
  await db.delete(verificationCode).where(eq(verificationCode.userId, userId));
  
  const code = generateRandomString(8, alphabet("0-9"));
  await db.insert(verificationCode).values({
    userId,
    type: "email",
    code,
    email,
    expiresAt: createDate(new TimeSpan(15, "m")) // 15 minutes
  });
	return code;
}

export async function verifyVerificationCode(user: User, code: string): Promise<boolean> {
  return await db.transaction(async (tr) => {
    const verificationCodes = await tr.select()
      .from(verificationCode)
      .where(eq(verificationCode.userId, user.id));
    
    const verificationCodeData = verificationCodes[0];
    if (!verificationCodeData || verificationCodeData.code !== code) return false;

    await tr.delete(verificationCode).where(eq(verificationCode.userId, user.id));
    if (!isWithinExpirationDate(verificationCodeData.expiresAt)) return false;
    if (verificationCodeData.email !== user.email) return false;
    return true;
  });
}