import type { APIContext } from "astro";
import { lucia } from "~/auth/auth.ts";

export const prerender = false;
export async function POST(context: APIContext): Promise<Response> {
  if (!context.locals.session)
    return new Response(null, { status: 401 });

  await lucia.invalidateSession(context.locals.session.id);

  const cookie = lucia.createBlankSessionCookie();
  context.cookies.set(cookie.name, cookie.value, cookie.attributes);
  return context.redirect("/");
}