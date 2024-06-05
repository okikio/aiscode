
import { GITHUB_CLIENT_ID, GITHUB_CLIENT_SECRET } from "~/env.ts";
import { GitHub } from "arctic";

export const github = new GitHub(
  GITHUB_CLIENT_ID!,
  GITHUB_CLIENT_SECRET!,
);