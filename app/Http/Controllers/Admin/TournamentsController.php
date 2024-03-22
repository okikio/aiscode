<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TournamentReward;
use App\Models\Tournaments;
use App\Models\Game;
use App\Models\Leaderboards;
use App\Models\LeaderBoardReport;
use App\Models\User;
use Yajra\Datatables\Datatables;
use App\Models\Winner;
use Carbon\Carbon;

class TournamentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->path = 'admin.tournaments';
        $this->status = array(
            'running'   => 'Running',
            'upcoming'  => 'Upcoming',
            'completed' => 'Completed'
        );
        $count = Winner::get()->count();
        if($count != 0){
            for ($i=1; $i <= $count; $i++) { 
                $this->number_of_winner[] = $i;
            }
        }else{
            $this->number_of_winner = [];
        }
        $this->game = Game::where('status','active')->whereIn('slug',['pummel-a-politicians','tikimatch-3','clownmatch-3'])->orderBy('name','asc')->pluck('name','id');
        
        View()->share('path', $this->path);
        View()->share('status', $this->status);
        View()->share('game', $this->game);
        View()->share('number_of_winner', $this->number_of_winner);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Datatables $datatables){
        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id', 'title' => 'Sr.No', "orderable"=> false, "searchable"=> false],
            ['data' => 'game_id', 'name' => 'game_id', 'title' => 'Game Name', "orderable"=> true, "searchable"=> true],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name', "orderable"=> true, "searchable"=> true],
            ['data' => 'start_date', 'name' => 'start_date', 'title' => 'Start Date & Time', "orderable"=> true, "searchable"=> true],
            ['data' => 'end_date', 'name' => 'end_date', 'title' => 'End Date & Time', "orderable"=> true, "searchable"=> true],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status', "orderable"=> false, "searchable"=> false],
            ['data' => 'action', 'name' => 'Action', 'title' => 'Action', "orderable"=> false, "searchable"=> false],
            ['data' => 'leaderboard', 'name' => 'leaderboard', 'title' => 'Leader Board', "orderable"=> false, "searchable"=> false]
        ];
        $tournament = Tournaments::orderBy('id', 'desc');
        if (request()->ajax()) {
            return $datatables->of($tournament->get())
                ->editColumn('game_id',function (Tournaments $tournaments){
                    return $tournaments->getGame->name;
                })
                ->editColumn('start_date',function (Tournaments $tournaments){
                    return $tournaments->start_date.' '.$tournaments->start_time;
                })
                ->editColumn('end_date',function (Tournaments $tournaments){
                    return $tournaments->end_date.' '.$tournaments->end_time;
                })
                ->addColumn('status', function (Tournaments $tournament) {
                    $s="";
                    if ($tournament->status == 'running') {
                        $s .= '<button type="button" class="btn btn-info btn-block btn-sm">Running</button>';
                    } else if($tournament->status == 'upcoming'){
                        $s .= '<button type="button" class="btn btn-danger btn-block btn-sm">Upcoming</button>';
                    } else {
                        $s .= '<button type="button" class="btn btn-success btn-block btn-sm">Completed</button>';
                    }
                    return $s;
                })
                ->addColumn('action', function (Tournaments $tournament) {
                    $action = "";
                    $action.= '<a href="'.route($this->path.'.show', $tournament->id).'"  data-toggle="tooltip" title="Show" data-id="'.$tournament->id.'" class="btn btn-outline-primary mr-1 mb-1"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                    $action.= '<a href="'.route($this->path.'.edit', $tournament->id).'"  data-toggle="tooltip" title="Edit" data-id="'.$tournament->id.'" class="btn btn-outline-success mr-1 mb-1"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                    $action.= '<a onclick="deleteTournaments('.$tournament->id.')" data-toggle="tooltip" title="Delete" data-id="'.$tournament->id.'" class="btn btn-outline-danger mr-1 mb-1"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;';
                    
                    return $action;
                })
                ->addColumn('leaderboard', function (Tournaments $tournament) {
                    $leaderboard = "";
                    $leaderboard.= '<a href="'.route($this->path.'.leaderboard', $tournament->id).'" data-toggle="tooltip" title="Leaderboards" data-id="'.$tournament->id.'" class="btn btn-outline-primary mr-1 mb-1"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                    
                    return $leaderboard;
                })
                ->rawColumns(['status','action','leaderboard'])
                ->addIndexColumn()
                ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)
            ->parameters([
                'order' =>[],
                'paging'      => true,
                'info'        => true,
                'searchDelay' => 350,
            ]);
        return view($this->path.'.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->path.'.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $cat_id = Game::where('id',$request->get('game_id'))->first();
            $today = Carbon::now()->format('Y-m-d H:i');
            $end_date = $request->end_date.' '.date("H:i", strtotime($request->end_time));
            $start_date = $request->start_date.' '.date("H:i", strtotime($request->start_time));
            if($today >= $end_date){
                $status  = 'completed';
            }else if($today >= $start_date){
                $status  = 'running';
            }else if($today < $start_date){
                $status  = 'upcoming';
            }
            $tournament = Tournaments::create([
                'name'              => $request->get('name'),
                'game_id'           => $request->get('game_id'),
                'start_date'        => $request->get('start_date'),
                'start_time'        => $request->get('start_time'),
                'end_date'          => $request->get('end_date'),
                'end_time'          => $request->get('end_time'),
                'number_of_winner'  => $request->get('number_of_winner'),
                'status'            => $status,
                'session_time'      => $request->get('session_time'),
                'description'       => $request->get('description'),
                'category_id'       => $cat_id->category_id
            ]);
            foreach ($request->winner_id as $key => $value) {
                $winner = Winner::where('id',$value)->first();
                TournamentReward::create([
                    'tournament_id' => $tournament->id,
                    'winner_id'     => $value,
                    'rank'          => $request->rank[$key],
                    'reward_name'   => $request->reward_name[$key],
                    'reward'        => $request->reward[$key],
                    'reward_code'   => $request->reward_code[$key],
                    'description'   => $winner->description
                ]);
            }
            toastr('Tournaments added successfully','success');
            return redirect()->route($this->path.'.index');
        } catch (\Exception $e) {
            return back()->with([
            'alert-type' => 'danger',
            'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tournaments = Tournaments::find($id);
        $reward = TournamentReward::where('tournament_id',$id)->pluck('winner_id');
        $winner = Winner::whereIn('id',$reward)->get();
        return view($this->path.'.show',compact('tournaments','winner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tournaments = Tournaments::find($id);
        $reward = TournamentReward::where('tournament_id',$id)->pluck('winner_id');
        $winner = Winner::whereIn('id',$reward)->get();
        return view($this->path.'.edit',compact('tournaments','winner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tournaments = Tournaments::find($id);
        try {
            if($tournaments){
                $cat_id = Game::where('id',$request->get('game_id'))->first();
                $today = Carbon::now()->format('Y-m-d H:i');
                $end_date = $request->end_date.' '.date("H:i", strtotime($request->end_time));
                $start_date = $request->start_date.' '.date("H:i", strtotime($request->start_time));
                if($today >= $end_date){
                    $status  = 'completed';
                }else if($today >= $start_date){
                    $status  = 'running';
                }else if($today < $start_date){
                    $status  = 'upcoming';
                }
                $tournament = Tournaments::where('id',$id)->update([
                'name'              => $request->get('name'),
                'game_id'           => $request->get('game_id'),
                'start_date'        => $request->get('start_date'),
                'start_time'        => $request->get('start_time'),
                'end_date'          => $request->get('end_date'),
                'end_time'          => $request->get('end_time'),
                'number_of_winner'  => $request->get('number_of_winner'),
                'status'            => $status,
                'session_time'      => $request->get('session_time'),
                'description'       => $request->get('description'),
                'category_id'       => $cat_id->category_id
            ]);
                TournamentReward::where('tournament_id',$id)->delete();
                foreach ($request->winner_id as $key => $value) {
                    $winner = Winner::where('id',$value)->first();
                    TournamentReward::create([
                        'tournament_id' => $id,
                        'winner_id'     => $value,
                        'rank'          => $request->rank[$key],
                        'reward_name'   => $request->reward_name[$key],
                        'reward'        => $request->reward[$key],
                        'reward_code'   => $request->reward_code[$key],
                        'description'   => @$winner->description
                    ]);
                }
                toastr('Tournaments updated successfully','success');
            }else{
                toastr('Tournaments not found','error');
            }
            return redirect()->route($this->path.'.index');
        } catch (\Exception $e) {
            dd($e);
            return back()->with([
            'alert-type' => 'danger',
            'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tournaments = Tournaments::find($id);
        if ($tournaments) {
            Leaderboards::where('tournament_id',$id)->delete();
            TournamentReward::where('tournament_id',$id)->delete();
            $tournaments->delete();
            $msg = 'Tournaments deleted Successfully';
            return ["status"=>'success',"message"=>$msg];
        } else {
            $msg = 'Tournaments not found';
            return ["status"=>'error',"message"=>$msg];
        }
    }

    public function winnerList(Request $request)
    {
        $winner_list = Winner::take($request->winner)->get();
        return view($this->path.'.winner_list',compact('winner_list'));
    }

    public function leaderboard(Request $request,Datatables $datatables,string $id)
    {
        $columns = [
            ['data' => 'rank', 'name' => 'rank', 'title' => 'Rank', "orderable"=> true, "searchable"=> true],
            ['data' => 'nick_name', 'name' => 'nick_name', 'title' => 'Nickname', "orderable"=> true, "searchable"=> true],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email Address', "orderable"=> true, "searchable"=> true],
            ['data' => 'score', 'name' => 'score', 'title' => 'Score', "orderable"=> true, "searchable"=> true],
            ['data' => 'reward', 'name' => 'reward', 'title' => 'Reward', "orderable"=> true, "searchable"=> true],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Date & Time', "orderable"=> true, "searchable"=> true],
            ['data' => 'logs', 'name' => 'logs', 'title' => 'LeaderBoard Logs', "orderable"=> false, "searchable"=> false]
        ];
        $leaderboard = Leaderboards::where('tournament_id',$id)->orderBy('rank','asc');
        $tournaments = Tournaments::find($id);
        if (request()->ajax()) {
            return $datatables->of($leaderboard->get())
                ->editColumn('nick_name',function (Leaderboards $leaderboard){
                    return $leaderboard->getUser->nick_name;
                })
                ->editColumn('created_at',function (Leaderboards $leaderboard){
                    return $leaderboard->created_at;
                })
                ->addColumn('email',function (Leaderboards $leaderboard){
                    return $leaderboard->getUser->email;
                })
                ->editColumn('score',function (Leaderboards $leaderboard){
                    return (string)$leaderboard->score;
                })
                ->addColumn('logs',function (Leaderboards $leaderboard){
                    $logs = "";
                    $logs.= '<a href="'.route($this->path.'.leaderboard-report', [$leaderboard->user_id,$leaderboard->tournament_id,$leaderboard->id]).'" data-toggle="tooltip" title="Leaderboards Logs" data-id="'.$leaderboard->user_id.'" class="btn btn-outline-primary mr-1 mb-1"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                    return $logs;
                })
                ->rawColumns(['logs','score'])
                ->addIndexColumn()
                ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)
            ->parameters([
                'order' =>[],
                'paging'      => true,
                'info'        => true,
                'searchDelay' => 350,
                'dom' => 'lBfrtip',
                'buttons' => [
                    [
                        'extend' => 'excelHtml5',
                        'text' => 'Export Tournament Leaderboard',
                        'title'=> 'Tournament Leaderboard Data - '.$tournaments->name,
                    ],
                ],
            ]);
        return view($this->path.'.leaderboard', compact('html','tournaments'));
    }

    public function leaderboardLogs(Request $request,Datatables $datatables,string $user_id,string $id,string $leaderboard){
        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'id', 'title' => 'Sr.No', "orderable"=> false, "searchable"=> false],
            ['data' => 'score', 'name' => 'score', 'title' => 'Score', "orderable"=> true, "searchable"=> true],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Date & Time', "orderable"=> true, "searchable"=> true],
        ];
        $leaderboard = LeaderBoardReport::where('user_id',$user_id)->where('leaderboard_id',$leaderboard);
        $user = User::find($user_id);
        if (request()->ajax()) {
            return $datatables->of($leaderboard->get())
                ->editColumn('created_at',function (LeaderBoardReport $leaderboard){
                    return $leaderboard->created_at;
                })
                ->editColumn('score',function (LeaderBoardReport $leaderboard){
                    return (string)$leaderboard->score;
                })
                ->rawColumns(['score'])
                ->addIndexColumn()
                ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)
            ->parameters([
                'order' =>[],
                'paging'      => true,
                'info'        => true,
                'searchDelay' => 350,
                'dom' => 'lBfrtip',
                'buttons' => [
                    [
                        'extend' => 'excelHtml5',
                        'text' => 'Export Leaderboard Logs',
                        'title'=> 'Leaderboard Logs - '.@$user->nick_name,
                    ],
                ],
            ]);
        return view($this->path.'.leaderboard_report', compact('html','user','id'));
    }
}
