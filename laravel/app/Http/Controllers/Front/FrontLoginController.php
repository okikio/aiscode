<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ActivationLink;
use App\Models\UserActivationLink;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class FrontLoginController extends Controller
{
    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
        $this->redirectTo = route('home');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    public function showLoginForm(){
        return view('front.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);
        if(auth()->guard('web')->attempt(['email' => $request->email,  'password' => $request->password])){
            if(Auth::guard('web')->user()->status === 'inactive'){
                Auth::guard('web')->logout();
                toastr('You are not authorized user','error');
                return redirect()->back();
            }else if(Auth::guard('web')->user()->isActive === '0'){
                Auth::guard('web')->logout();
                $activation_link = UserActivationLink::Create([
                    'email'             => $request->email,
                    'activation_link'   => \Str::random(60)
                ]);
                $user = User::where('email',$request->email)->first();
                $mailData = [
                    'name' => $user->name.' '.$user->last_name,
                    'url'  => url('activation_link/'.$activation_link->activation_link)
                ];
                Mail::to($request->email)->send(new ActivationLink($mailData));
                toastr('Please activate your account.We have send activation link in your email','error');
                return redirect()->back();
            }else{
                Auth::guard('web')->user()->ip_address = $request->ip();
                Auth::guard('web')->user()->save();
                toastr('Welcome to Iwin Game!','success');
                return redirect()->route('home');
            }
        }else {
            toastr('You are not authorized user','error');
            return redirect()->back();
        }

        return back()->withInput($request->only('email'))->withErrors([
            'error' => 'These credentials do not match our records.',
        ]);;

    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect()->route('front.login');
    }
}
