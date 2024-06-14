import type { APIContext } from "astro";
import * as signup from "~/actions/signup.ts";

export const prerender = false;
export async function POST(context: APIContext): Promise<Response> {
  const formData = await context.request.formData();

  const username = formData.get("username")! as string;
  const password = formData.get("password")! as string;
  
  const email = formData.get("email")! as string;
  const above_18 = formData.get("above_18")! as unknown as boolean;

  const result = await signup.handler({ username, password, email, above_18 });
  return result.match(
    cookie => {
      context.cookies.set(cookie.name, cookie.value, cookie.attributes);
      return context.redirect("/");
    },
    err => {
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
