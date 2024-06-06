import { pgTable, text, varchar, timestamp, integer, primaryKey } from 'drizzle-orm/pg-core';

export const user = pgTable('user', {
  id: text('id').primaryKey(),
  username: varchar('username').notNull(),
  hash: varchar('hash'),
  email: varchar('email').unique().notNull(),
  image: text("image"),
  bio: text('bio'),
});

export const session = pgTable("session", {
  id: text("id").primaryKey(),
  userId: text("userId")
    .notNull()
    .references(() => user.id, { onDelete: "cascade" }),
  expiresAt: timestamp("expires_at", {
    withTimezone: true,
    mode: "date"
  }).notNull()
})

// Accounts represent the different types of ways a user can signin
export const oauthAccount = pgTable("oauth_account", {
  userId: text('user_id').notNull().references(() => user.id, { onDelete: "cascade" }),

  provider: text("provider").notNull(),
  providerAccountId: text("providerAccountId").notNull(),

  // The password field stores the base64-encoded string representing the hashed and salted password.
  // refreshToken: text("refresh_token"),
  // accessToken: text("access_token"),
  // expiresAt: integer("expires_at"),
  // tokenType: text("token_type"),
  // scope: text("scope"),

  // idToken: text("id_token"),  // Stores the ID token for user authentication
  // sessionState: text("session_state"),  // Manages session state for SSO and stateful sessions
},
  (account) => ({
    compoundKey: primaryKey({ 
      columns: [account.provider, account.providerAccountId] 
    }),
  })
)

// // VerificationTokens table schema
// export const verificationTokens = pgTable("verificationToken",
//   {
//     // Identifier, usually the email, used to link the token to the user.
//     identifier: text("identifier").notNull(),

//     // The verification token sent to the user's email for account verification.
//     token: text("token").notNull(),

//     // Expiry date of the token for security purposes.
//     expires: timestamp("expires", { mode: "date" }).notNull(),
//   },
//   (vt) => ({
//     compoundKey: primaryKey({ 
//       columns: [vt.identifier, vt.token] 
//     }),
//   })
// );