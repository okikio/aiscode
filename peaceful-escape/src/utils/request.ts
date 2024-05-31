// utils/request.js
export function getRequestSegment(index: number, location: URL) {
  const segments = location.pathname.split('/').filter(x => Boolean(x));
  return segments[index - 1] || '';
}
