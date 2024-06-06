<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Mail\ActivationLink;
use App\Models\UserActivationLink;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class FrontRegisterController extends Controller
{
    public function showrRegisterForm(){
        return view('front.auth.register');
    }

    public function register(Request $request)
    {
        try {
            $user_email = User::where('email',$request->email)->first();
            $user_phone = User::where('phone_number',$request->phone_number)->first();
            if(!empty($user_email->email)){
                return ["status"=>'error',"message"=>'Email already in used'];
            }
            if(!empty($user_phone->phone_number)){
                return ["status"=>'error',"message"=>'Phone number already in used'];
            }
            $date = $request->year.'-'.$request->month.'-'.$request->date;
            $user = User::create([
                'name'              => $request->first_name,
                'last_name'         => $request->last_name,
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'phone_number'      => $request->phone_number,
                'birth_date'        => $date,
                'nick_name'         => $request->nick_name,
                'ip_address'        => $request->ip()
            ]);
            $activation_link = UserActivationLink::Create([
                'email'             => $user->email,
                'activation_link'   => \Str::random(60)
            ]);
            $mailData = [
                'name' => $request->first_name.' '.$request->last_name,
                'url'  => url('activation_link/'.$activation_link->activation_link)
            ];
            Mail::to($request->email)->send(new ActivationLink($mailData));
            return ["status"=>'success',"message"=>''];
        } catch (\Exception $e) {
            return ["status"=>'error',"message"=>$e->getMessage()];
            return back()->with([
                'alert-type' => 'danger',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function activationLink($token)
    {
        $activation_link = UserActivationLink::where('activation_link', $token)->first();
        if (!$activation_link) {
            toastr('This activation link is invalid.Please contact to admin.','error');
            return redirect()->route('home');
        }else{
            if (Carbon::parse($activation_link->updated_at)->addMinutes(720)->isPast()) {
                $activation_link->delete();
                toastr('This activation link is invalid.Please contact to admin.','error');
                return redirect()->route('home');
            }else{
                $user = User::where('email',$activation_link->email)->first();
                $user->isActive = '1';
                $user->save();
                toastr('Your account is activated now.','success');
                return redirect()->route('front.login');
            }
            toastr('This activation link is invalid.Please contact to admin.','error');
            return redirect()->route('home');
        }
    }
}
