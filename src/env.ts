import { generateSecret } from "~/utils/secret.ts";
import { encodeBase64 } from "@std/encoding";

import * as process from "node:process";
import * as dotenv from "dotenv";

dotenv.config();
dotenv.config({
  path: ".env.local",
});

export const {
  MODE, 
  PGHOST, PGDATABASE, PGUSER, PGPASSWORD,
  GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET,
  GITHUB_CLIENT_ID, GITHUB_CLIENT_SECRET,
  AUTH_SECRET = encodeBase64(generateSecret(32)),
  AUTH_REDIRECT_URL,
} = process.env;
export const PGPORT = +(process.env.PGPORT ?? 5432);