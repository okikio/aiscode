<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class LoginController extends Controller
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
    protected $redirectTo = '/admin/dashboard';
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        $this->redirectTo = route('admin.dashboard');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }


    public function showLoginForm(){
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);
        $remember_me = $request->has('remember_me') ? true : false;
        if(auth()->guard('admin')->attempt(['email' => $request->email,  'password' => $request->password], $remember_me)){
            toastr('Welcome to dashboard!','success');
            return redirect()->route('admin.dashboard');
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
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
