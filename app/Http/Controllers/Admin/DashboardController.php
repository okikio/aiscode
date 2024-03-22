<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\Game;
use App\Models\Category;
use App\Models\Tournaments;
use Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $user = User::get()->count();
        $game = Game::get()->count();
        $category = Category::get()->count();
        $tournaments = Tournaments::get()->count();
        $activeUser = User::where('status','active')->get()->count();
        return view('admin.dashboard',compact('user','game','category','tournaments','activeUser'));
    }

    public function getProfile()
    {
        $admin = auth()->user();
        return view('admin.profile',compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = auth()->user();
        if ($admin) {
            if($request->hasFile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(10).'.'.$extension;
                Storage::disk('public')->putFileAs('admin', $file,$filename);
                $admin->image = $filename;
            }
            $admin->name = $request->name;
            // $admin->email = $request->email;
            $admin->save();
            toastr('Profile Updated Successfully','success');
            return redirect()->route('admin.profile');
        }else{
            toastr('Admin Not Found','error');
            return redirect()->route('admin.profile');
        }
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'c_password'  => 'required',
            'password'    => 'required|string|min:6|confirmed',
        ]);
        $admin = Admin::find(auth()->user()->id);
        if ($admin) {
            if (!(Hash::check($request->get('c_password'), auth()->user()->password))) {
                toastr('Your current password does not matches with the password you provided. Please try again.','error');
                return redirect()->back();
            }
            if (strcmp($request->get('c_password'), $request->get('password')) == 0) {
                toastr('New Password cannot be same as your current password. Please choose a different password.','error');
                return redirect()->back();
            }
            $admin = auth()->user();
            $admin->password =Hash::make($request->get('password'));
            $admin->save();
            toastr('Password Changed Successfully','success');
            return redirect()->back();
        } else {
            toastr('Admin Not Found','error');
            return redirect()->route('admin.profile');
        }
    }
}
