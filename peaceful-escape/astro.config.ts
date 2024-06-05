import { defineConfig } from 'astro/config';

import tailwind from "@astrojs/tailwind";
import solid from "@astrojs/solid-js";
import vercel from "@astrojs/vercel/serverless";

// https://astro.build/config
export default defineConfig({
  integrations: [
    // tailwind(), 
    solid(),
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