import type { APIContext } from "astro";
import * as signup from "~/actions/signup.ts";

export const prerender = false;
export async function POST(context: APIContext): Promise<Response> {
  const formData = await context.request.formData();
  const username = formData.get("username")! as string;
  const password = formData.get("password")! as string;
  const email = formData.get("email")! as string;

  const result = await signup.handler({ username, password, email, });
  return result.match(
    cookie => {
      context.cookies.set(cookie.name, cookie.value, cookie.attributes);
      return context.redirect("/");
    },
    err => {
      return new Response(JSON.stringify({ error: err.message }), {
        status: 400,
        headers: { "Content-Type": "application/json" }
      });
    }
  );
}
