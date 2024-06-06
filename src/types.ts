// types.ts
export interface FutureTournament {
  name: string;
  start_date: string;
}

export interface WinningData {
  reward: string;
  getUser: {
    name: string;
  };
  getTournaments: {
    name: string;
  };
}
