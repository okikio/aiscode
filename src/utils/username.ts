import { generateRandomInteger } from "oslo/crypto";

/**
 * List of nouns that can be used to generate usernames.
 */
export const nouns = [
  "apple", "banana", "cherry", "date", "elderberry", "fig", "grape", "honeydew", "kiwi", "lemon",
  "mango", "nectarine", "orange", "papaya", "quince", "raspberry", "strawberry", "tangerine", "ugli",
  "vanilla", "watermelon", "xigua", "yam", "zucchini", "ant", "bee", "cat", "dog", "elephant", "fox",
  "goat", "horse", "iguana", "jaguar", "kangaroo", "lion", "monkey", "narwhal", "octopus", "penguin",
  "quail", "rabbit", "snake", "tiger", "urchin", "vulture", "wolf", "xenopus", "yak", "zebra",
  "airplane", "bicycle", "car", "drone", "elevator", "ferry", "gondola", "helicopter", "icebreaker", "jet",
  "kayak", "limousine", "motorcycle", "navy", "oceanliner", "parachute", "quad", "rocket", "submarine", "tank",
  "unicycle", "van", "wagon", "xerox", "yacht", "zeppelin", "book", "computer", "desk", "envelope", "file",
  "glove", "hat", "instrument", "jacket", "key", "lamp", "microphone", "notebook", "oar", "piano",
  "quilt", "ring", "shoes", "telephone", "umbrella", "vase", "whistle", "xylophone", "yarn", "zither"
];

/**
 * List of adjectives that can be used to generate usernames.
 */
export const adjectives = [
  "happy", "sad", "angry", "excited", "bored", "calm", "anxious", "brave", "careful", "daring",
  "eager", "fearless", "gentle", "happy", "innocent", "jolly", "kind", "lazy", "mighty", "nervous",
  "obedient", "proud", "quiet", "rude", "shy", "thoughtful", "upset", "victorious", "witty", "youthful",
  "zealous", "adventurous", "bold", "charming", "delightful", "energetic", "friendly", "graceful", "humble", "intelligent",
  "jovial", "keen", "loving", "mysterious", "neat", "optimistic", "playful", "quick", "resourceful", "strong",
  "talented", "unique", "vibrant", "wise", "xenial", "young", "zany", "active", "brilliant", "creative",
  "determined", "enthusiastic", "faithful", "generous", "honest", "imaginative", "jocular", "kindhearted", "loyal", "motivated",
  "nice", "observant", "persistent", "quiet", "reliable", "sincere", "trustworthy", "understanding", "versatile", "warm",
  "xenodochial", "yare", "zephyr", "agile", "brisk", "cheerful", "diligent", "earnest", "funny", "gregarious"
];

/**
 * List of verbs that can be used to generate usernames.
 */
export const verbs = [
  "run", "jump", "swim", "dance", "sing", "write", "read", "eat", "sleep", "think",
  "play", "walk", "drive", "fly", "cook", "paint", "draw", "build", "climb", "shop",
  "talk", "listen", "watch", "learn", "teach", "catch", "throw", "bake", "wash", "clean",
  "repair", "grow", "lift", "carry", "fix", "ride", "sew", "knit", "create", "design",
  "invent", "explore", "discover", "search", "find", "collect", "arrange", "organize", "plan", "prepare",
  "improve", "solve", "change", "help", "assist", "care", "nurture", "guide", "inspire", "encourage",
  "motivate", "support", "defend", "protect", "challenge", "train", "coach", "practice", "develop", "achieve",
  "succeed", "win", "lose", "try", "test", "analyze", "observe", "measure", "calculate", "predict",
  "report", "record", "document", "examine", "research", "study", "understand", "interpret", "explain", "express",
  "suggest", "recommend", "advise", "warn", "persuade", "convince", "negotiate", "sell", "buy", "trade"
];

/**
 * Combined list of all usable words (nouns, verbs, adjectives) for generating usernames.
 */
export const usableWords = [...nouns, ...verbs, ...adjectives];

/**
 * Generates a random username by combining a random adjective, noun, verb, and a random number in random order.
 * 
 * @returns {string} The generated random username.
 * 
 * @example
 * const username = generateRandomUsername();
 * console.log(username); // e.g., "jumpbananahappy7843"
 * 
 * @remarks
 * The total number of possible unique usernames is calculated as follows:
 * - 300 choices for each word (nouns, adjectives, and verbs combined).
 * - 10,000 possible numbers (from 0 to 9999 inclusive).
 * - 24 possible permutations of the 4 elements (4!).
 * 
 * Therefore, the total number of unique usernames is:
 * 300 * 300 * 300 * 10,000 * 24 = 648,000,000,000 unique usernames.
 */
export function generateRandomUsername(): string {
  // Select random words from the usableWords list
  const randomNoun = usableWords[generateRandomInteger(usableWords.length)];
  const randomAdjective = usableWords[generateRandomInteger(usableWords.length)];
  const randomVerb = usableWords[generateRandomInteger(usableWords.length)];

  // Generate a random number between 0 and 9999
  const randomNumber = generateRandomInteger(10_000);

  // Create an array with the selected words and the random number
  const elements = [randomAdjective, randomNoun, randomVerb, randomNumber.toString()];

  // Shuffle the elements array using Fisher-Yates algorithm
  for (let i = elements.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [elements[i], elements[j]] = [elements[j], elements[i]];
  }

  // Join the elements into a single string to form the username
  return elements.join('');
}

/**
 * Generates a unique username based on the provided email address and a random number.
 * 
 * @param {string} email - The email address to base the username on.
 * @param {number} [randomDigits=10_000] - The upper limit for the random number to be appended (default is 10,000).
 * @returns {string} The generated unique username.
 * 
 * @example
 * const username = generateUsernameFromEmail("user@example.com");
 * console.log(username); // e.g., "user1234"
 * 
 * @remarks
 * This function extracts the name part of the email, removes special characters, and appends a random number to create a unique username.
 */
export function generateUsernameFromEmail(
  email: string,
  randomDigits: number = 10_000
): string {
  // Retrieve the name part from the email address
  const nameParts = email.replace(/@.+/, "");

  // Remove all special characters from the name part
  const name = nameParts.replace(/[&/\\#,+()$~%._@'":*?<>{}]/g, "");

  // Generate a random number and append it to the cleaned name to form the username
  return name + generateRandomInteger(randomDigits);
}
