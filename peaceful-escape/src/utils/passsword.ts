import { Argon2id } from "oslo/password";
import { decodeBase64 } from "@std/encoding";
import { AUTH_SECRET } from "~/env.ts";

export const Argon2 = new Argon2id({
  secret: decodeBase64(AUTH_SECRET)
});

export function hash(password: string) {
  return Argon2.hash(password);
}

export function verify(hash: string, password: string) {
  return Argon2.verify(hash, password);
}