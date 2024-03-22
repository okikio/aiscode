<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use App\Mail\ResetPasswordSuccessMail;

class FrontPasswordResetController extends Controller
{
    public function showPasswordRest(){
        return view('front.auth.forgot');
    }

    // Send email with rest password link to the user.
    public function create(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            toastr("We can't find a user with that e-mail address.","error");
            return redirect()->route('front.login');
        }else if($user->login_type == 'social'){
            toastr("Forgot password's request sends only for normal user.you have registered with social login .","error");
            return redirect()->route('front.login');
        } else {
            $passwordReset = PasswordReset::updateOrCreate(
                ['email' => $user->email],
                [
                    'email' => $user->email,
                    'token' => \Str::random(60)
                ]
            );
            if ($user && $passwordReset) {
                $url = url('password/find/'.$passwordReset->token);

                $mailData = [
                    'name'  =>  $user->name,
                    'url'   =>  $url,
                ];

                Mail::to($user->email)->send(new ForgotPasswordMail($mailData));
                
                toastr("We have e-mailed your password reset link!","success");
                return redirect()->route('front.login'); 
            }
        }
    }

    // Show Reset Password page
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();
        if (!$passwordReset) {
            return back()->with([
                'alert-type'   => 'danger',
                'message' => 'This password reset token is invalid.'
            ]);
        }
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return back()->with([
                'alert-type'   => 'danger',
                'message' => 'This password reset token is invalid.'
            ]);
        }
        return view('front.auth.resetPassword', compact('passwordReset'));
    }
    // Rest password
    public function reset(Request $request)
    {
        $passwordReset = PasswordReset::where(['token'=>$request->token,'email'=>$request->email])->first();
        if (!$passwordReset) {
            toastr("We can't find a user with that e-mail address.","error");
            return redirect()->back();
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            toastr("We can't find a user with that e-mail address.","error");
            return redirect()->back();
        } else {
            if (strcmp($request->get('password_confirmation'), $request->get('password')) != 0) {
                toastr('Confirm password can be same as your new password.','error');
                return redirect()->back();
            }
            $user->password = \Hash::make($request->password);
            $user->save();
            $mailData = [
                'name'  =>  $user->name,
            ];
            Mail::to($user->email)->send(new ResetPasswordSuccessMail($mailData));
            $passwordReset->delete();
            toastr("Password reset successfully.","success");
            return redirect()->route('front.login');
        }
    }
}
