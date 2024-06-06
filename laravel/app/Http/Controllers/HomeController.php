<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CmsPage;
use App\Models\Game;
use App\Models\Tournaments;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;
use App\Models\Leaderboards;

class HomeController extends Controller
{
    function __construct()
    {
        $this->future_tournaments = Tournaments::whereDate('start_date','>', date('Y-m-d'))->get()->take(4);
        $this->winning_data = Leaderboards::where('reward','!=','-')->orderBy('score','desc')->get()->unique('user_id')->take(3);
        $this->latest_tournament = Leaderboards::where('rank','1')->orderBy('id','desc')->first();
        View()->share('future_tournaments', $this->future_tournaments);
        View()->share('winning_data', $this->winning_data);
        View()->share('latest_tournament', $this->latest_tournament);
    }
    
    public function index()
    {
        $game = Game::where('status','active')->get();
        $category = Category::get();
        return view('welcome',compact('game','category'));
    }

    public function contactUs()
    {
        return view('front.pages.contactus');
    }

    public function postcontactUs(Request $request)
    {
        $admin_email = CmsPage::where('slug','contact-us')->first();
        $mailData = [
            'name'          => $request->first_name.' '.$request->last_name,
            'email'         => $request->email,
            'department'    => $request->department,
            'subject'       => $request->subject
        ];
        Mail::to($admin_email->email)->send(new ContactUsMail($mailData));
        toastr('Mail send','success');
        return redirect()->route('home');
    }

    public function cmsPages($slug)
    {
        $cms_data = CmsPage::where('slug',$slug)->first();
        return view('front.pages.cms-page',compact('cms_data'));
    }

    public function practiceRoom($slug)
    {
        $game = Game::where('slug',$slug)->first();
        return view('front.practice.practice-room',compact('game'));
    }

    public function search(Request $request)
    {
        if(!empty($request->text)){
            $game = \DB::table('games')->where('name','LIKE','%'.$request->text.'%')->pluck('slug')->toArray();
            // $game = Game::where('name',$request->text)->pluck('slug')->toArray();
            if(count($game)>0){
                $not_game = Game::whereNotIn('slug',$game)->pluck('slug')->toArray();
                return response()->json(['status'=>'success','data'=>$game,'data2'=>$not_game]);
            }else{
                return response()->json(['status'=>'error']);
            }
        }else{
            return response()->json(['status'=>'error']);
        }
    }
}