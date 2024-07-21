<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Events\ExampleEvent;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function logout()
    {
        event(new ExampleEvent(['username' => auth()->user()->username, 'action' => 'logout']));
        auth()->logout();
        return redirect('/')->with('success', 'شما با موفقیت خارج شدید.');
    }

    public function showCorrectPage()
    {
        if(auth()->check())
        {
            $posts = auth()->user()->feedPosts()->latest()->paginate(5);
            return view('home-feed', compact('posts'));
        }
        else
        {
            $postCount = Cache::remember('postCount', 20, function(){
                return $postCount = Post::count();
            });
            return view('home', ['postCount' => $postCount]);
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
             event(new ExampleEvent(['username' => auth()->user()->username, 'action' => 'login']));
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
