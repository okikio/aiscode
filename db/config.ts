import { defineDb, defineTable, column } from 'astro:db';

const OAuthRequests = defineTable({
  columns: {
    id: column.text({ primaryKey: true }),
    state: column.text({ optional: false }),
    codeVerifier: column.text({ optional: false }),
    provider: column.text(),
    createdAt: column.date({ default: new Date() }),
  }
})

// https://astro.build/db/config
export default defineDb({
  tables: {
    OAuthRequests
  }
});
