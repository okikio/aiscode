import type { APIRoute } from 'astro';
import { Category, games } from '../data/data.ts';

import type { Results } from '@orama/orama';
import { create, insertMultiple, search } from '@orama/orama';

// Define the schema type
interface GameSchema {
  name: string;
  slug: string;
  image: string;
  alt: string;
  url: string;
  category?: Category; // Uncomment and adjust if you need this field
}

// Create the database with the specified schema
const db = await create({
  schema: {
    name: 'string',
    slug: 'string',
    image: 'string',
    alt: 'string',
    url: 'string',
    category: 'enum',
  },
})

// @ts-ignore `games` are erroring out
await insertMultiple(db, games);

const responseInit = {
  headers: new Headers({
    "content-type": "application/json"
  })
};

export const prerender = false;
export const GET: APIRoute = async (ctx) => {
  const text = ctx.url.searchParams.get('text'); // Extract the 'text' parameter

  if (!text) {
    return new Response(
      JSON.stringify({
        status: "error",
        data: [],
      }),
      responseInit
    );
  }

  const searchResult: Results<GameSchema> = await search(db, { 
    term: text,
    properties: '*',
    threshold: 0.02,
  });

  const hits = searchResult?.hits?.map(x => x.document!.slug);
  console.log({
    text,
    hits,
  })

  return new Response(
    JSON.stringify({
      status: "success",
      data: hits,
    }),
    responseInit
  );
};
