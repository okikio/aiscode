import type { APIContext } from "astro";
import type { z } from "zod";
import * as request from "~/actions/oauth/request.ts";

// Example usage in the API route
export const prerender = false;
export async function GET(context: APIContext): Promise<Response> {
  const provider = context.params.provider! as z.infer<typeof request.schema>["provider"];

  // Call the handler function and handle the Result
  const result = await request.handler({ provider });
  return result.match(
    url => {
    // Redirect to the authorization URL if successful
      return context.redirect(url);
    },
    err => {
    // Return an error response if there was an error
      return new Response(
        JSON.stringify({
          error: typeof err === "string" ? err : (err?.flatten?.() ?? err?.message)
        }), {
        status: 400,
        headers: { "Content-Type": "application/json" }
      });
    }
  );
}
