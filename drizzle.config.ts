import { PGHOST, PGDATABASE, PGUSER, PGPASSWORD, PGPORT } from "./src/env.ts";
import { defineConfig } from "drizzle-kit";

export default defineConfig({
  schema: "./src/db/schema.ts",
  out: "./migrations",
  dialect: 'postgresql',
  dbCredentials: {
    host: PGHOST!,
    database: PGDATABASE!,
    user: PGUSER!,
    password: PGPASSWORD!,
    port: PGPORT!,
    ssl: false,
  }
});