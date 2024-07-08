<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function createFollow(User $user)
    {
        // You can not follow yourself
        if(auth()->user()->id == $user->id)
        {
            return back()->with('failure', 'شما نمی توانید خودتان را دنبال کنید.');
        }

        // You can not follow who you are folliwng already
        $existFollow = Follow::where('user_id', '=', auth()->user()->id)->where('followed_user', '=', $user->id)->count();

        if($existFollow)
        {
            return back()->with('failure', 'شما نمی توانید کاربری را که قبلا دنبال کرده اید مجدد دنبال کنید.');
        }

        $follow = new Follow();
        $follow->user_id = auth()->user()->id;
        $follow->followed_user = $user->id;
        $follow->save();

        return back()->with('success', 'کاربر مورد نظر با موفقیت دنبال شد.');
    }

    public function removeFollow(User $user)
    {
        Follow::where('user_id', '=', auth()->user()->id)->where('followed_user', '=', $user->id)->delete();
        return back()->with('success', 'کاربر مورد نظر با موفقیت آنفالو شد.');
    }

   
}
