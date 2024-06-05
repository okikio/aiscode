// Function to generate a cryptographically secure random secret using Web Crypto API
export function generateSecret(length: number = 32) {
  const array = new Uint8Array(length);
  crypto.getRandomValues(array);
  return array;
}