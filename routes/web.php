<?php

use App\Events\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\MustBeLoggedIn;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;

// User routes
Route::get('/', [UserController::class, 'showCorrectPage']);
Route::post('register', [UserController::class, 'register'])->middleware('guest');
Route::post('login', [UserController::class, 'login'])->middleware('guest');
Route::post('logout', [UserController::class, 'logout'])->middleware(MustBeLoggedIn::class);

// Post routes
Route::get('create-post', [PostController::class, 'showCreatePostForm'])->middleware(MustBeLoggedIn::class);
Route::post('create-post', [PostController::class, 'storePost'])->middleware(MustBeLoggedIn::class);
Route::get('post/{post}', [PostController::class, 'showSinglePost']);
Route::delete('post/{post}', [PostController::class, 'delete'])->can('delete', 'post');
Route::get('post/{post}/edit', [PostController::class, 'showEditForm'])->can('update', 'post');
Route::put('post/{post}', [PostController::class, 'updatePost'])->can('update', 'post');
Route::get('search/{term}', [Postcontroller::class, 'search']);

// Profile routes
Route::get('profile/{username:username}', [ProfileController::class, 'showPosts']);
Route::get('profile/{username:username}/followers', [ProfileController::class, 'profileFollowers']);
Route::get('profile/{username:username}/followings', [ProfileController::class, 'profileFollowings']);

Route::middleware('cache.headers:public;max_age=20')->group(function(){
    Route::get('profile/{username:username}/raw', [ProfileController::class, 'showPostsRaw']);
    Route::get('profile/{username:username}/followers/raw', [ProfileController::class, 'profileFollowersRaw']);
    Route::get('profile/{username:username}/followings/raw', [ProfileController::class, 'profileFollowingsRaw']);
});

Route::get('manage-avatar', [ProfileController::class, 'showChangeAvatarForm'])->middleware(MustBeLoggedIn::class);
Route::post('store-avatar', [ProfileController::class, 'storeAvatar'])->middleware(MustBeLoggedIn::class);


// Follow routes
Route::post('create-follow/{user:username}', [FollowController::class, 'createFollow'])->middleware(MustBeLoggedIn::class);
Route::post('remove-follow/{user:username}', [FollowController::class, 'removeFollow'])->middleware(MustBeLoggedIn::class);

// Chat routes
Route::post('send-chat-message', function(Request $request){
    $formFields = $request->validate([
        'textvalue' => 'required'
    ]);

    if(!trim(strip_tags($formFields['textvalue'])))
    {
        return response()->noContent();
    }

    broadcast(new ChatMessage(['username' => auth()->user()->username, 'textvalue' => $formFields['textvalue'], 'avatar' => auth()->user()->avatar]))->toOthers();
    return response()->noContent();

})->middleware(MustBeLoggedIn::class);