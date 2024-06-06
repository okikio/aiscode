import { defineAction } from "astro:actions";
import * as signup from "./signup.ts";

export const server = {
  signup: defineAction({
    accept: 'form',
    input: signup.schema,
    handler: signup.handler,
  }),
};