import { defineConfig } from 'astro/config';

import vercel from "@astrojs/vercel/serverless";
import solid from "@astrojs/solid-js";
import db from "@astrojs/db"; 

import tailwind from "@astrojs/tailwind";

// https://astro.build/config
export default defineConfig({
  integrations: [
    // tailwind(), 
    solid(),
    db(),
  ],
  output: "hybrid",
  adapter: vercel(),
  experimental: {
    actions: true,
  },
  vite: {
    optimizeDeps: {
      exclude: ["oslo"]
    }
  }
});