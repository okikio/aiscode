<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;
use App\Models\Tournaments;
use App\Models\Leaderboards;
use App\Models\TournamentReward;
use App\Models\AffiliateUser;
use App\Models\AffiliateAds;
use Carbon\Carbon;
use App\Models\StartGame;
use App\Models\LeaderBoardReport;

class ApiController extends Controller
{
    public function getTournamentData(Request $request)
    {
        $url = trim($request->url);
        $url_data = explode('/',$url);
        if($url_data[3] == 'tournaments-room'){
            $tournaments = Tournaments::where('id',$url_data[5])->first();
            $game = Game::where('slug',$url_data[4])->first();
            $data = array(
                'tournament_id' => $url_data[5],
                'game_id'       => $game->id,
                'user_id'       => $url_data[6],
                'session_time'  => $tournaments->session_time,
                'end_date'      => $tournaments->end_date,
                'end_time'      => $tournaments->end_time,
            );
            $status = 'success';
            $message = 'Data found';
        }else{
            $data = "";
            $status = 'error';
            $message = 'The url does not match';
        }    
        return response()->json(['status'=>$status,'message'=>$message,'data'=>$data]);
    }

    public function addGameScore(Request $request)
    {
        $game_data = Leaderboards::where('tournament_id',$request->tournament_id)->where('user_id',$request->user_id)->first();
        $redirect_url = url('tournaments');
        if(empty($game_data)){
            $leaderboard = Leaderboards::create([
                'tournament_id' => $request->tournament_id,
                'game_id'       => $request->game_id,
                'user_id'       => $request->user_id,
                'score'         => $request->score
            ]);
            LeaderBoardReport::create([
                'leaderboard_id' => $leaderboard->id,
                'user_id'        => $request->user_id,
                'score'          => $request->score
            ]);
        }else{
            LeaderBoardReport::create([
                'leaderboard_id' => $game_data->id,
                'user_id'        => $request->user_id,
                'score'          => $request->score
            ]);
            if($request->score > $game_data->score){
                $game_data->score = $request->score;
                $game_data->save();
            }
        }
        return response()->json(['status'=>'success','message'=>'Score Added','redirect_url'=>$redirect_url]);
    }

    public function rewardAssign()
    {
        $leaderboard = Leaderboards::orderBy('tournament_id','desc')->get();
        if(count($leaderboard)>0){
            foreach ($leaderboard as $key => $value) {
                $count = Leaderboards::where('tournament_id',$value->tournament_id)->count();
                $tournamen_rank = Leaderboards::where('tournament_id',$value->tournament_id)->orderBy('score','desc')->get()->take($count);
                $no = 1;
                foreach ($tournamen_rank as $key => $val) {
                    $users = Leaderboards::where('id',$val->id)->first();
                    $tournament = TournamentReward::where('tournament_id',$val->tournament_id)->where('rank',$no)->first();
                    if(!empty($tournament)){
                        $reward = $tournament->reward;
                        $reward_name = $tournament->reward_name;
                        $reward_id = $tournament->id;
                    }else{
                        $reward = "-";
                        $reward_name = NULL;
                        $reward_id = NULL;
                    }
                    $users->rank = $no;
                    $users->reward = $reward;
                    $users->reward_name = $reward_name;
                    $users->reward_id = $reward_id;
                    $users->save();
                    $no++;
                }
            }
        }
    }

    public function affiliateUser()
    {
        $affiliate_id = AffiliateAds::first();
        $users = User::where('affiliate_id',$affiliate_id->id)->get()->take(5);
        if(count($users)>0){
            foreach ($users as $key => $value) {
                $rand = rand(10,100);
                $amount = floor(($rand + 10)/10) * 10;
                $today = Carbon::now()->format('Y-m-d');
                $today_user = AffiliateUser::where('user_id',$value->id)->whereDate('created_at',$today)->first();
                if(empty($today_user)){
                    AffiliateUser::create([
                        'affiliate_id'  =>  $value->affiliate_id,
                        'user_id'       =>  $value->id,
                        'amount'        =>  $amount 
                    ]);
                }
            }
        }
    }

    public function tournamentStatus()
    {
        // 'running', 'upcoming', 'completed'
        $tournament = Tournaments::get();
        $today = Carbon::now()->format('Y-m-d H:i');
        if(count($tournament)>0){
            foreach ($tournament as $key => $value) {
                $end_date = $value->end_date.' '.date("H:i", strtotime($value->end_time));
                $start_date = $value->start_date.' '.date("H:i", strtotime($value->start_time));
                if($today >= $end_date){
                    $value->status  = 'completed';
                }else if($today >= $start_date){
                    $value->status  = 'running';
                }else if($today < $start_date){
                    $value->status  = 'upcoming';
                }
                $value->save();
            }
        }
    }

    public function startGame(Request $request)
    {
        $check_user = StartGame::where('tournament_id',$request->tournament_id)->where('user_id',$request->user_id)->delete();
        StartGame::create([
            'tournament_id'=>$request->tournament_id,
            'user_id'=>$request->user_id
        ]);
        return response()->json(['status'=>'success']);
    }
}