
import { GITHUB_CLIENT_ID, GITHUB_CLIENT_SECRET, AUTH_REDIRECT_URL } from "~/env.ts";
import { GitHub } from "arctic";

export const github = new GitHub(
  GITHUB_CLIENT_ID!,
  GITHUB_CLIENT_SECRET!,
  { redirectURI: AUTH_REDIRECT_URL }
);