<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\passwordResetMail;

class LoginController extends Controller
{
    protected $email;
    public function index() {
        return view('index');
    }

    public function authenticate(Request $request) {
        $loginData = $request->only('email', 'password');

        if(Auth::attempt($loginData)) {

            $user = DB::select('select * from users where userId = ? and email = ?', [1, $loginData['email']]);
            if(count($user) != 0) {
                $request->session()->put('adminEmail', $request->input('email'));
                return redirect()->intended('/admin');
            }
            $request->session()->put('userEmail', $request->input('email'));
            return redirect()->intended('/home');
        } else {return back()->withErrors(['email' => 'The provided credentials do not match our records.']);}

    }

    public function toResetPasswordPage() {return view('pages.toResetPasswordPage');}
    public function resetPasswordMailSend(Request $request) {
        $details = [
            'title' => "Rénitialisation de mot de passe",
            'content' => "Vueillez cliquer sur ce lien pour rénitialiser votre mot de passe:",
            'link' => "http://localhost:8000/resetPassword/x46azrz45e/".$request->input('email')
        ];

        Mail::to($request->input('email'))->send(new passwordResetMail($details));
        return view('pages.resetEamilSent');
    }
    public function getResetPassword($code, $email) {
        $code_is_correct = isset($code) && $code == "x46azrz45e";
        $emailIsSet = isset($email);
        if($code_is_correct && $emailIsSet) {
            return view('pages.renitializeForm')->with('email', $email);
        }

    }
    public function resetPassword(Request $request) {
        DB::update('update users set password = ? where email = ?', [bcrypt($request->input('password')), $request->input('email')]);
        return redirect('/');
    }
}
