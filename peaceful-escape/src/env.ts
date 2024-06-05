import { generateSecret } from "~/utils/secret.ts";
import { encodeBase64 } from "@std/encoding";

import * as process from "node:process";
import * as dotenv from "dotenv";

dotenv.config();
dotenv.config({
  path: ".env.local",
});

export const {
  PGHOST, PGDATABASE, PGUSER, PGPASSWORD,
  GITHUB_CLIENT_ID, GITHUB_CLIENT_SECRET,
  EMAIL, EMAIL_PASS, 
  MODE, AUTH_SECRET = encodeBase64(generateSecret(32)),
  NEXTAUTH_URL,
} = process.env;
export const PGPORT = +(process.env.PGPORT ?? 5432);