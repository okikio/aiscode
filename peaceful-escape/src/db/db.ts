import { PGHOST, PGDATABASE, PGUSER, PGPASSWORD, PGPORT } from "~/env.ts";

import { drizzle } from 'drizzle-orm/postgres-js';
import postgres from 'postgres';

// Disable prefetch as it is not supported for "Transaction" pool mode 
export const sql = postgres(
  `postgres://${PGUSER}:${PGPASSWORD}@${PGHOST}:${PGPORT}/${PGDATABASE}`, 
  { prepare: false }
);
export const db = drizzle(sql, { logger: true });