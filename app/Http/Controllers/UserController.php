<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'شما با موفقیت خارج شدید.');
    }

    public function showCorrectPage()
    {
        if(auth()->check())
        {
            return view('home-feed');
        }
        else
        {
            return view('home');
        }
    }

    public function login(Request $request)
    {
        $input = $request->validate([
            'login-password' => ['required'],
            'login-username' => ['required']
        ]);

        if(auth()->attempt(['username' => $input['login-username'], 'password' => $input['login-password']]))
        {
             $request->session()->regenerate();
             return redirect('/')->with('success', 'با موفقیت وارد شدید.');
        }
        else
        {
            return redirect('/')->with('failure', 'اطلاعات ورودی شما نادرست است.');
        }
    }

    public function register(Request $request)
    {
        $inputs = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create($inputs);
        auth()->login($user);
        return redirect('/')->with('success', 'شما با موفقیت ثبت نام کردید.');
    }
}