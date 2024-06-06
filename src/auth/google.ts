
import { GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET, AUTH_REDIRECT_URL } from "~/env.ts";
import { Google } from "arctic";

const redirectUri = AUTH_REDIRECT_URL?.replace?.("[provider]", "google");
export const google = new Google(
  GOOGLE_CLIENT_ID!,
  GOOGLE_CLIENT_SECRET!,
  redirectUri!,
);