<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Admin;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use App\Mail\ResetPasswordSuccessMail;

class PasswordResetController extends Controller
{
    public function showPasswordRest()
    {
        return view('admin.auth.resetPassword');
    }

    // Send email with rest password link to the admin.
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            toastr("We can't find a admin with that e-mail address.","error");
            return redirect()->route('admin.login');
        } else {
            $passwordReset = PasswordReset::updateOrCreate(
                ['email' => $admin->email],
                [
                    'email' => $admin->email,
                    'token' => \Str::random(60)
                ]
            );
            if ($admin && $passwordReset) {
                $url = url('admin/password/find/'.$passwordReset->token);

                $mailData = [
                    'name'  =>  $admin->name,
                    'url'   =>  $url,
                ];

                Mail::to($admin->email)->send(new ForgotPasswordMail($mailData));
                
                toastr("We have e-mailed your password reset link!","success");
                return redirect()->route('admin.login'); 
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
        return view('admin.auth.reset', compact('passwordReset'));
    }
    // Rest password
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required',
            'token' => 'required|string'
        ]);
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email],
        ])->first();
        if (!$passwordReset) {
            toastr("We can't find a admin with that e-mail address.","error");
            return redirect()->back();

            return back()->with([
                'alert-type' => 'danger',
                'message' => 'This password reset token is invalid.'
            ]);
        }
        $admin = Admin::where('email', $passwordReset->email)->first();
        if (!$admin) {
            toastr("We can't find a admin with that e-mail address.","error");
            return redirect()->back();
        } else {
            $admin->password = \Hash::make($request->password);
            $admin->save();
            $passwordReset->delete();
            $mailData = [
                'name'  =>  $admin->name,
            ];
            Mail::to($admin->email)->send(new ResetPasswordSuccessMail($mailData));
            toastr("Password reset successfully.","success");
            return redirect()->route('admin.login');
        }
    }
}
