<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Tournaments;
use App\Models\Category;
use App\Models\Leaderboards;
use App\Models\StartGame;

class FrontTournamentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->latest_tournament = Leaderboards::where('rank','1')->orderBy('id','desc')->first();
        View()->share('latest_tournament', $this->latest_tournament);
        $this->middleware('auth:web');
    }

    public function index()
    {
        $tournaments = Tournaments::where('status','!=','completed')->get();
        $category = Category::get();
        $future_tournaments = Tournaments::where('start_date','>', date('Y-m-d'))->get()->take(7);
        return view('front.tournaments.index',compact('tournaments','category','future_tournaments'));
    }

    public function tournamentsRoom($slug,$id,$user_id)
    {
        $game = Game::where('slug',$slug)->first();
        $tournaments = Tournaments::find($id);
        $leaderboard = Leaderboards::where('tournament_id',$id)->orderBy('score','desc')->pluck('user_id')->take(7)->toArray();
        if(count($leaderboard)>0){
            if(in_array($user_id,$leaderboard)){
                $leaderboard_data = Leaderboards::where('tournament_id',$id)->orderBy('score','desc')->get()->take(7);
                $user_data = "";
                $user_leader = true;
            }else{
                $user_score_find = Leaderboards::where('tournament_id',$id)->where('user_id',$user_id)->first();
                if(!empty($user_score_find)){
                    $leaderboard_data = Leaderboards::where('tournament_id',$id)->orderBy('score','desc')->get()->take(6);
                    $user_data = Leaderboards::where('tournament_id',$id)->where('user_id',$user_id)->first();
                    $user_leader = false;
                }else{
                    $leaderboard_data = Leaderboards::where('tournament_id',$id)->orderBy('score','desc')->get()->take(7);
                    $user_data = "";
                    $user_leader = true;
                }
            }
        }else{
            $leaderboard_data = array();
            $user_data = "";
            $user_leader = false;
        }
        $today = \Carbon\Carbon::now()->format('Y-m-d H:i');
        $end_date = $tournaments->end_date.' '.date("H:i", strtotime($tournaments->end_time));
        $start_date = $tournaments->start_date.' '.date("H:i", strtotime($tournaments->start_time));
        if($today >= $start_date){
            return view('front.tournaments.tournament-room',compact('game','tournaments','leaderboard_data','user_data','user_leader'));
        }else if($today < $start_date){
            toastr('This tournament will be start soon','error');
            return redirect()->route('front.tournaments');
        }else if($today >= $end_date){
            return view('front.tournaments.tournament-room',compact('game','tournaments','leaderboard_data','user_data','user_leader'));
        }
    }

    public function startGame(Request $request)
    {
        $start_game = StartGame::where('tournament_id',$request->tournament_id)->where('user_id',$request->user_id)->first();
        $tournaments = Tournaments::find($request->tournament_id);
        if(!empty($start_game)){
            return ["status"=>'success',"session_time"=>$tournaments->session_time];
        }else{
            return ["status"=>'error',"session_time"=>""];
        }
    }
}