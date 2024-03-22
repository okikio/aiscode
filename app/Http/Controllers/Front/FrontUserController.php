<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Storage;
use Illuminate\Support\Str;
use App\Models\Leaderboards;
use App\Models\Tournaments;

class FrontUserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->future_tournaments = Tournaments::where('start_date','>', date('Y-m-d'))->get()->take(4);
        $this->winning_data = Leaderboards::where('reward','!=','-')->orderBy('score','desc')->get()->unique('user_id')->take(3);
        $this->latest_tournament = Leaderboards::where('rank','1')->orderBy('id','desc')->first();
        View()->share('latest_tournament', $this->latest_tournament);
        View()->share('future_tournaments', $this->future_tournaments);
        View()->share('winning_data', $this->winning_data);
        $this->middleware('auth:web');
    }
    
    public function profile()
    {
        return view('front.user.profile');
    }

    public function submitGame()
    {
        return view('front.pages.submit-game');
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('front.user.edit-profile',compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            if($request->hasFile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(10).'.'.$extension;
                Storage::disk('public')->putFileAs('user', $file,$filename);
                $user->image = $filename;
            }
            if($request->password){
                $user->password = Hash::make($request->password);
            }
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->nick_name = $request->nick_name;
            $user->birth_date = $request->birth_date;
            $user->phone_number = $request->phone_number;
            $user->save();
            return ["status"=>'success',"message"=>'Profile Updated Successfully'];
        }else{
            return ["status"=>'error',"message"=>'User Not Found'];
        }
    }

    public function linkedAccount($social)
    {
        return \Socialite::driver($social)->redirect();
    }
}