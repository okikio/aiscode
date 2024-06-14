import type { APIContext } from "astro";
import type { z } from "zod";
import * as callback from "~/actions/oauth/callback.ts";

export const prerender = false;
export async function GET(context: APIContext): Promise<Response> {
  const code = context.url.searchParams.get("code")! as string;
  const state = context.url.searchParams.get("state")! as string;
  const provider = context.params.provider! as z.infer<typeof callback.schema>["provider"];

  const result = await callback.handler({ code, state, provider });
  return result.match(
    cookie => {
      context.cookies.set(cookie.name, cookie.value, cookie.attributes);
      return context.redirect("/");
    },
    err => {
      console.error({
        error: typeof err === "string" ? err : (err?.flatten?.() ?? err?.message)
      });
      return new Response(
        null, {
        status: 400,
        headers: { "Content-Type": "application/json" }
      });
    }
  );
}
