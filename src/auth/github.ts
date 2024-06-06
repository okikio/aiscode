
import { GITHUB_CLIENT_ID, GITHUB_CLIENT_SECRET, AUTH_REDIRECT_URL } from "~/env.ts";
import { GitHub } from "arctic";

const redirectUri = AUTH_REDIRECT_URL?.replace?.("[provider]", "github");
export const github = new GitHub(
  GITHUB_CLIENT_ID!,
  GITHUB_CLIENT_SECRET!,
  { redirectURI: redirectUri }
);