/// <reference path="../.astro/db-types.d.ts" />
/// <reference path="../.astro/actions.d.ts" />
/// <reference types="astro/client" />
interface ImportMetaEnv {
  readonly DB_PASSWORD: string;
  readonly PUBLIC_POKEAPI: string;
  // more env variables...
}

interface ImportMeta {
  readonly env: ImportMetaEnv;
}

declare namespace Astro {
  interface Locals {
    session: import("lucia").Session | null;
    user: import("lucia").User | null;
  }
}
