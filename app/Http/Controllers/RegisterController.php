<?php

namespace App\Http\Controllers;

use App\Mail\ValidationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index() {return view('pages/register');}

    public function register(Request $request) {

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $birthday = $request->input('birthday');
        $email = $request->input('email');
        $password = $request->input('password');
        $status = 'passif';

        $user_exist = DB::select('select * from users');
        if(count($user_exist) == 0) $status = 'actif';

        $request->validate([
            'firstname' => 'required|string|max:20',
            'lastname' => 'required|string|max:20',
            'birthday' => 'required',
            'email' => 'required|email|unique:users,email',
            'confirmEmail' => 'required|email|same:email',
            'password' => 'required|alpha_num|max:8',
            'confirmPassword' => 'required|same:password',
        ]);

        $inputs = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'birthday' => $birthday,
            'email' => $email,
            'password' => bcrypt($password),
            'status' => $status
        ];
        User::create($inputs);
        $text = [
            'title' => "Verification email",
            'content' => "Veuillez cliquer sur le lien afin de vérifer votre email: ",
            'email' => $email
        ];
        Mail::to($email)->send(new ValidationMail($text));
        event(new Registered($inputs));
        return view('pages.emailSent');
    }
}
