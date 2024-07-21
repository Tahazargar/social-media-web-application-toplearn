<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    private function getSharedData($username)
    {
        $postCount = $username->posts()->count();
        $currentUsername = $username->username;
        $avatar = $username->avatar;
        $followersCount = $username->followers()->count();
        $followingsCount = $username->followTheUsers()->count();
        $followingOrNot = 0;
        
        if(auth()->check())
        {
            $followingOrNot = Follow::where([['user_id', '=', auth()->user()->id], ['followed_user', '=', $username->id]])->count();
        }

        View::share('sharedData', ['postCount' => $postCount, 'currentUsername' => $currentUsername, 'avatar' => $avatar, 'followingOrNot' => $followingOrNot, 'followersCount' => $followersCount, 'followingsCount' => $followingsCount]);
    }

    public function showPosts(User $username)
    {
        $this->getSharedData($username);
        $posts = $username->posts()->latest()->get();
        return view('profile-posts', compact('posts'));
    }

    public function showPostsRaw(User $username)
    {
        return response()->json(['theHTML' => view('profile-posts-only', ['posts' =>  $username->posts()->latest()->get()])->render(), 'docTitle' => $username->username . ' پروفایل']);
    }

    public function profileFollowers(User $username)
    {
        $this->getSharedData($username);
        $followers = $username->followers()->latest()->get();
        return view('profile-followers', compact('followers'));
    }

    public function profileFollowersRaw(User $username)
    {
        return response()->json(['theHTML' => view('profile-followers-only', ['followers' =>  $username->followers()->latest()->get()])->render(), 'docTitle' => $username->username . ' دنبال کنندگان']);
    }

    public function profileFollowings(User $username)
    {
        $this->getSharedData($username);
        $followings = $username->followTheUsers()->latest()->get();
        return view('profile-followings', compact('followings'));
    }

    public function profileFollowingsRaw(User $username)
    {
        return response()->json(['theHTML' => view('profile-followings-only', ['followings' =>  $username->followTheUsers()->latest()->get()])->render(), 'docTitle' => $username->username . ' دنبال شوندگان']);

    }

    public function showChangeAvatarForm()
    {
        return view('avatar-form');
    }

    public function storeAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'max:1000']
        ]);

        $user = auth()->user();

        $imageName = time() . '.jpg';
        $image = ImageManager::imagick()->read($request->file('avatar'));
        $image->resize(120, 120)->toJpeg()->save('storage/avatar/' . $imageName);

        $oldAvatar = $user->avatar;

        $user->avatar = $imageName;
        $user->save();

        if($oldAvatar != '/fallback-avatar.png')
        {
            Storage::delete(str_replace('/storage/', 'public/', $oldAvatar));
        }

        return redirect('/manage-avatar')->with('success', 'تصویر پروفایل شما با موفقیت تغییر کرد.');
    }
}
