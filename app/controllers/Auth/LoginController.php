<?php


namespace App\Controllers\Auth;

use App\Controllers\Session;
use App\Models\User;

class LoginController
{
    public function login()
    {
        if (Session::has('login_user'))
            header('Location: ' . asset('home'));
        else {
            $request = request();
            if ($request->isMethod('POST')) {
                $email = strip_tags($request->email);
                $password = strip_tags($request->password);
                $user_password = User::select('password')->where('email', $email)->first();
                if (!empty($user_password))
                {
                    if (password_verify($password, $user_password->password))
                    {
                        session('login_user', true);
                        session(0, 0, 'login_error');
                        header('Location: ' . asset('home'));
                    }
                    else
                        session('login_error', true);
                } else {
                    session('login_error', true);
                }
            }

            return view('auth/login');
        }
    }

    public function logout()
    {
        session(0, 0, 'login_user');
        header('Location: ' . route('login'));
    }
}