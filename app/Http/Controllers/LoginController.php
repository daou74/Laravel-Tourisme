<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Services\EmailService;

class LoginController extends Controller
{
    protected $request;

    public function __construct(Request $request){
        $this->request = $request;
    }
    
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function existEmail(){
        $email = $this->request->input('email');
        $user = User::where('email', $email)->first();
        $response = ($user) ? "exist" : "not_exist";
        return response()->json(['response' => $response]);
    }

    public function activationCode($token){
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('danger', 'This token doesn\'t match any user.');
        }

        if ($this->request->isMethod('post')) {
            $code = $user->activation_code;
            $activation_code = $this->request->input('activation-code');

            if ($activation_code != $code) {
                return back()->with([
                    'danger' => 'This activation code is invalid!',
                    'activation_code' => $activation_code
                ]);
            } else {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'is_verified' => 1,
                        'activation_code' => '',
                        'activation_token' => '',
                        'email_verified_at' => now(),
                        'updated_at' => now()
                    ]);

                return redirect()->route('login')->with('success', 'Your email address has been verified!');
            }
        }

        return view('auth.activation_code', ['token' => $token]);
    }

    public function userChecker(){
        $activation_token = Auth::user()->activation_token;
        $is_verified = Auth::user()->is_verified;

        if ($is_verified != 1) {
            Auth::logout();

            return redirect()->route('app_activation_code', ['token' => $activation_token])
                ->with('warning', 'Your account is not activated yet. Please check your mailbox and activate your account or resend the confirmation message.');
        } else {
            return redirect()->route('app_dashboard');
        }
    }

    public function resendActivationCode($token)
    {
        $user = User::where('activation_token', $token)->first();
        $email = $user->email;
        $name = $user->name;
        $activation_token = $user->activation_token;
        $activation_code = $user->activation_code;

        $emailSend = new EmailService;
        $subject = "Activate your Account";
        
        $emailSend->sendEmail($subject, $email, $name, true, $activation_code, $activation_token);

        return redirect()->route('app_activation_code', ['token' => $token])->with('success', 'You have just resent the new activation code.');
    }

    public function activationAcccountLink($token)
    {
        $user = User::where('activation_token', $token)->first();
        
        if (!$user) {
            return redirect()->route('login')->with('danger', 'This token doesn\'t match any user.');
        }

        DB::table('users')
        ->where('id', $user->id)
        ->update([
            'is_verified' => 1,
            'activation_code' => '',
            'activation_token' => '',
            'email_verified_at' => now(),
            'updated_at' => now()
        ]);

    return redirect()->route('login')->with('success', 'Your email address has been verified!');
    }

    public function ActivationAccountChangeEmail($token)
    {
        $user = User::where('activation_token', $token)->first();

        if ($this->request->isMethod('post')) {

            // 
            $new_email = $this->request->input('new-email');
            $user_exixte = User::where('email', $new_email)->first();
            if($user_exixte)
            {
                return back()->with([
                    'danger' => 'This address email is already used! Please enter another email address!',
                    'new_email' => $new_email
                ]);
            }
            else
            {
                DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'email'=>$new_email,
                    'updated_at' => now()
                ]);
                $activation_code=$user->activation_code;
                $activation_token=$user->activation_token;
                $name=$user->name;

                $emailSend = new EmailService;
                $subject = "Activate your Account";
                $message = view('mail.confirmation_email')
                     ->with([
                             'name' => $name,
                             'activation_code' => $activation_code,
                             'activation_token' => $activation_token
                ]);
                $emailSend->sendEmail($subject, $new_email, $name, true, $activation_code, $activation_token);

                return redirect()->route('app_activation_code', ['token' => $token])->with('success', 'You have just resent the new activation code.');

            }
        }
        else{
            return view('auth.activation_account_change_email', [
                'token'=>$token
            ]);
    
        }     
    }
}