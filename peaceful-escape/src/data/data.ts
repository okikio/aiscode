// data.ts
export const enum Category {
  PUZZLE_GAMES = 'PUZZLE GAMES',
  ARCADE_GAMES = 'ARCADE GAMES',
  ACTION_GAMES = 'ACTION GAMES',
  CARD_GAMES = 'CARD GAMES',
  SLOTS = 'SLOTS'
}

export interface Game {
  category: Category;
  name: string;
  slug: string;
  image: string;
  alt: string;
  url: string;
}

export const games: Game[] = [
  // PUZZLE GAMES
  {
    category: Category.PUZZLE_GAMES,
    name: 'TiKiMATCH 3',
    slug: 'tikimatch-3',
    image: 'https://www.iwingaming.com/storage/game/oG6EfEGgYh.png',
    alt: 'TiKiMATCH 3',
    url: 'https://www.iwingaming.com/practice-room/tikimatch-3'
  },
  {
    category: Category.PUZZLE_GAMES,
    name: 'ClownMatch 3',
    slug: 'clownmatch-3',
    image: 'https://www.iwingaming.com/storage/game/91PBrEiXL5.png',
    alt: 'ClownMatch 3',
    url: 'https://www.iwingaming.com/practice-room/clownmatch-3'
  },
  {
    category: Category.PUZZLE_GAMES,
    name: 'Jigsaw Deluxe Puzzle',
    slug: 'jigsaw-deluxe-puzzle',
    image: 'https://www.iwingaming.com/storage/game/YevgROT1b3.png',
    alt: 'Jigsaw Deluxe Puzzle',
    url: 'https://www.iwingaming.com/practice-room/jigsaw-deluxe-puzzle'
  },
  {
    category: Category.PUZZLE_GAMES,
    name: 'Word Up',
    slug: 'word-up',
    image: 'https://www.iwingaming.com/storage/game/Gwrl6V470g.png',
    alt: 'Word Up',
    url: 'https://www.iwingaming.com/practice-room/word-up'
  },
  // ARCADE GAMES
  {
    category: Category.ARCADE_GAMES,
    name: 'Pummel A Politician',
    slug: 'pummel-a-politician',
    image: 'https://www.iwingaming.com/storage/game/qyfq1fyARY.png',
    alt: 'Pummel A Politician',
    url: 'https://www.iwingaming.com/practice-room/pummel-a-politician'
  },
  // ACTION GAMES
  {
    category: Category.ACTION_GAMES,
    name: 'DEAD CITY',
    slug: 'dead-city',
    image: 'https://www.iwingaming.com/storage/game/ZoGf1GY37W.png',
    alt: 'DEAD CITY',
    url: 'https://www.iwingaming.com/practice-room/dead-city'
  },
  {
    category: Category.ACTION_GAMES,
    name: 'Handless millionaire',
    slug: 'handless-millionaire',
    image: 'https://www.iwingaming.com/storage/game/JUzUYxixUX.png',
    alt: 'Handless millionaire',
    url: 'https://www.iwingaming.com/practice-room/handless-millionaire'
  },
  {
    category: Category.ACTION_GAMES,
    name: 'American Football',
    slug: 'american-football',
    image: 'https://www.iwingaming.com/storage/game/Cw00T3m8Yp.png',
    alt: 'American Football',
    url: 'https://www.iwingaming.com/practice-room/american-football'
  },
  {
    category: Category.ACTION_GAMES,
    name: 'Slot Kungfu',
    slug: 'slot-kungfu',
    image: 'https://www.iwingaming.com/storage/game/MqVwSV4if4.png',
    alt: 'Slot Kungfu',
    url: 'https://www.iwingaming.com/practice-room/slot-kungfu'
  },
  // CARD GAMES
  {
    category: Category.CARD_GAMES,
    name: 'Black Jack Casino',
    slug: 'black-jack-casino',
    image: 'https://www.iwingaming.com/storage/game/S5q8b5Ua2i.png',
    alt: 'Black Jack Casino',
    url: 'https://www.iwingaming.com/practice-room/black-jack-casino'
  },
  {
    category: Category.CARD_GAMES,
    name: 'Caribbean Stud Poker',
    slug: 'caribbean-stud-poker',
    image: 'https://www.iwingaming.com/storage/game/CozY4B5JYY.png',
    alt: 'Caribbean Stud Poker',
    url: 'https://www.iwingaming.com/practice-room/caribbean-stud-poker'
  },
  {
    category: Category.CARD_GAMES,
    name: 'Casino Cards Memory',
    slug: 'casino-cards-memory',
    image: 'https://www.iwingaming.com/storage/game/xiPZh71UYK.png',
    alt: 'Casino Cards Memory',
    url: 'https://www.iwingaming.com/practice-room/casino-cards-memory'
  },
  {
    category: Category.CARD_GAMES,
    name: 'Mahjong Deluxe',
    slug: 'mahjong-deluxe',
    image: 'https://www.iwingaming.com/storage/game/776znbwDTo.png',
    alt: 'Mahjong Deluxe',
    url: 'https://www.iwingaming.com/practice-room/mahjong-deluxe'
  },
  {
    category: Category.CARD_GAMES,
    name: 'Pyramid Solitaire',
    slug: 'pyramid-solitaire',
    image: 'https://www.iwingaming.com/storage/game/YvQ9FDO4GS.png',
    alt: 'Pyramid Solitaire',
    url: 'https://www.iwingaming.com/practice-room/pyramid-solitaire'
  },
  // SLOTS
  {
    category: Category.SLOTS,
    name: 'Pirate Slot',
    slug: 'pirate-slot',
    image: 'https://www.iwingaming.com/storage/game/954dmtHXn5.png',
    alt: 'Pirate Slot',
    url: 'https://www.iwingaming.com/practice-room/pirate-slot'
  },
  {
    category: Category.SLOTS,
    name: 'The Gold Pot Casino',
    slug: 'the-gold-pot-casino',
    image: 'https://www.iwingaming.com/storage/game/TyvU69V25j.png',
    alt: 'The Gold Pot Casino',
    url: 'https://www.iwingaming.com/practice-room/the-gold-pot-casino'
  }
];
