import { pgTable, text, varchar, timestamp, primaryKey, integer, serial } from 'drizzle-orm/pg-core';

export const user = pgTable('user', {
  id: text('id').primaryKey(),
  username: varchar('username').notNull(),
  hash: varchar('hash'),
  email: varchar('email').unique().notNull(),
  verified: timestamp("verified", { 
    withTimezone: true,
    mode: "date"
  }),
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

// VerificationCode table schema
export const verificationCode = pgTable("verification_code", {
  id: serial("id").primaryKey(),
  
  // Type of verification code, usually reset or verify "email" or "password".
  type: text("type").notNull(),

  // Foreign key to the user that the code is associated with.
  userId: text('user_id').notNull().references(() => user.id, { onDelete: "cascade" }),
  
  // Identifier, usually the email, used to link the code to the user.
  email: text("email").notNull(),

  // The verification code sent to the user's email for account verification.
  code: text("token").notNull(),

  // Expiry date of the token for security purposes.
  expiresAt: timestamp("expires_at", { 
    withTimezone: true,
    mode: "date"
  }).notNull(),
});