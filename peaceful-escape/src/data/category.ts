// Import the data
import type { Game } from '../data/data.ts';
import { games } from '../data/data.ts';

export interface Category {
  name: string;
  slug: string;
  getGame: Game[];
}

// Function to get unique categories from the games
export function getCategories (games: Game[]): Category[] {
  const categoriesMap = new Map<string, Game[]>();

  games.forEach(game => {
    if (!categoriesMap.has(game.category)) {
      categoriesMap.set(game.category, []);
    }
    categoriesMap.get(game.category)?.push(game);
  });

  const categories: Category[] = [];
  categoriesMap.forEach((gamesInCategory, category) => {
    categories.push({
      name: category,
      slug: category.replace(/\s+/g, '-').toLowerCase(),
      getGame: gamesInCategory
    });
  });

  return categories;
};

// Get categories from games
export const category = getCategories(games);