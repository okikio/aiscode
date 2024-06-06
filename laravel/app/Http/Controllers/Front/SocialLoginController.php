<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use App\Mail\ActivationLink;
use App\Models\UserActivationLink;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Log;

class SocialLoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
    */
    protected $redirectTo = '/home';

    /*public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
        $this->redirectTo = route('home');
    }*/

    protected function guard()
    {
        return Auth::guard('web');
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function Callback($provider,Request $request)
    {
         Log::error('Auth check: ', ['data' => Auth::check()]);
        try {
            $userSocial = Socialite::driver($provider)->stateless()->user();
            if(Auth::check() == false){
                $users = User::where(['email' => $userSocial->getEmail()])->first();
                $checkUser = User::where(['linked_fb_id' => $userSocial->getId()])->orwhere('linked_google_id',$userSocial->getId())->first();
                if(!(empty($checkUser))){
                    if($provider == 'facebook'){
                        $socialUser = User::where(['linked_fb_id' => $userSocial->getId()])->first();
                    }else{
                        $socialUser = User::where('linked_google_id',$userSocial->getId())->first();
                    }
                    Auth::login($socialUser);
                    $socialUser->ip_address = $request->ip();
                    $socialUser->save();
                    toastr('Welcome to Iwin Game!','success');
                    return redirect()->route('home');
                }else if(!empty($users)){
                    if($users->login_type == 'normal'){
                        Auth::guard('web')->logout();
                        toastr('Already created account with this email','error');
                        return redirect()->route('home');
                    }else{
                        if($users->provider != $provider){
                            Auth::guard('web')->logout();
                            toastr('Already created account with this email','error');
                            return redirect()->route('home');
                        }else if($users->status === 'inactive'){
                            Auth::guard('web')->logout();
                            toastr('You are not authorized user','error');
                            return redirect()->route('home');
                        }else{
                            Auth::login($users);
                            $users->ip_address = $request->ip();
                            $users->save();
                            toastr('Welcome to Iwin Game!','success');
                            return redirect()->route('home');
                        }
                    }
                }else{
                    if(!empty($checkUser)){
                        Auth::guard('web')->logout();
                        toastr('Already created account with this email','error');
                        return redirect()->route('home');
                    }else{
                        $username = explode(' ', $userSocial->getName());
                        $filename = $this->getSocialAvatar($userSocial->getAvatar());
                        $user = User::create([
                            'name'          => $username[0],
                            'last_name'     => @$username[1],    
                            'email'         => $userSocial->getEmail(),
                            'image'         => $filename,
                            'provider_id'   => $userSocial->getId(),
                            'provider'      => $provider,
                            'isActive'      => '1',
                            'login_type'    => 'social',
                            'ip_address'    => $request->ip()
                        ]);
                        Auth::login($user);
                        toastr('Welcome to Iwin Game!','success');
                        return redirect()->route('home');
                    }
                }   
            }else{
                if($provider == 'facebook'){
                    $checkWithOtherId = User::where(['linked_fb_id' => $userSocial->getId()])->where('id','!=',auth()->user()->id)->first();
                    $checkWithSameId = User::where(['linked_fb_id' => $userSocial->getId()])->where('id',auth()->user()->id)->first();
                    
                }else{
                    $checkWithOtherId = User::where(['linked_google_id' => $userSocial->getId()])->where('id','!=',auth()->user()->id)->first();
                    $checkWithSameId = User::where(['linked_google_id' => $userSocial->getId()])->where('id',auth()->user()->id)->first();
                }
                $checkId = User::where(['provider_id' => $userSocial->getId()])->first();
                if(empty($checkId)){
                    $userIdCheck = User::where(['id' => auth()->user()->id])->first();
                    if(!empty($checkWithOtherId)){
                        toastr('Already created account.So you can not linked this account with it','error');
                        return redirect()->route('front.profile');
                    }else if(!empty($checkWithSameId)){
                        toastr('Already linked with it','error');
                        return redirect()->route('front.profile');
                    }else{
                        if(empty($userIdCheck->linked_fb_id) && $provider == 'facebook'){
                            $userIdCheck->linked_fb_id = $userSocial->getId();
                            $userIdCheck->save();
                            toastr('Your account is linked with it','success');
                            return redirect()->route('front.profile');
                        }else if(empty($userIdCheck->linked_google_id) && $provider == 'google'){
                            $userIdCheck->linked_google_id = $userSocial->getId();
                            $userIdCheck->save();
                            toastr('Your account is linked with it','success');
                            return redirect()->route('front.profile');
                        }else{
                            toastr('Already linked with it','error');
                            return redirect()->route('front.profile');
                        }
                    }
                }else{
                    toastr('Already created account.So you can not linked this account with it','error');
                    return redirect()->route('front.profile');
                }
            }
        } catch (\Exception $e) {
            return back()->with([
                'alert-type' => 'danger',
                'message' => $e->getMessage()
            ]);
        }
    }

    /*public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function Callback($provider,Request $request)
    {
        try {
            $userSocial = Socialite::driver($provider)->user();
            $users = User::where(['email' => $userSocial->getEmail()])->first();
            if(!empty($users)){
                if($users->login_type == 'normal'){
                    Auth::guard('web')->logout();
                    toastr('Already created account with this email','error');
                    return redirect()->route('home');
                }else{
                    if($users->provider != $provider){
                        Auth::guard('web')->logout();
                        toastr('Already created account with this email','error');
                        return redirect()->route('home');
                    }else if($users->status === 'inactive'){
                        Auth::guard('web')->logout();
                        toastr('You are not authorized user','error');
                        return redirect()->route('home');
                    }else{
                        Auth::login($users);
                        $users->ip_address = $request->ip();
                        $users->save();
                        toastr('Welcome to Iwin Game!','success');
                        return redirect()->route('home');
                    }
                }
            }else{
                $username = explode(' ', $userSocial->getName());
                $filename = $this->getSocialAvatar($userSocial->getAvatar());
                $user = User::create([
                    'name'          => $username[0],
                    'last_name'     => $username[1],    
                    'email'         => $userSocial->getEmail(),
                    'image'         => $filename,
                    'provider_id'   => $userSocial->getId(),
                    'provider'      => $provider,
                    'isActive'      => '1',
                    'login_type'    => 'social',
                    'ip_address'    => $request->ip()
                ]);
                Auth::login($user);
                toastr('Welcome to Iwin Game!','success');
                return redirect()->route('home');
            }
            
        } catch (\Exception $e) {
            return back()->with([
                'alert-type' => 'danger',
                'message' => $e->getMessage()
            ]);
        }
    }*/

    function getSocialAvatar($file){
        $fileContents = file_get_contents($file);
        $filename = Str::random(10).'.jpg';
        $path = public_path().'/storage/user/'.$filename;
        File::put($path, $fileContents);
        return $filename;
    }
}