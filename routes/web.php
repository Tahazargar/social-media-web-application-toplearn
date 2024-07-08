<?php

use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\MustBeLoggedIn;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Mockery\Matcher\MustBe;

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

// Profile routes
Route::get('profile/{username:username}', [ProfileController::class, 'showPosts']);
Route::get('manage-avatar', [ProfileController::class, 'showChangeAvatarForm'])->middleware(MustBeLoggedIn::class);
Route::post('store-avatar', [ProfileController::class, 'storeAvatar'])->middleware(MustBeLoggedIn::class);
Route::get('profile/{username:username}/followers', [ProfileController::class, 'profileFollowers']);
Route::get('profile/{username:username}/followings', [ProfileController::class, 'profileFollowings']);

// Follow routes
Route::post('create-follow/{user:username}', [FollowController::class, 'createFollow'])->middleware(MustBeLoggedIn::class);
Route::post('remove-follow/{user:username}', [FollowController::class, 'removeFollow'])->middleware(MustBeLoggedIn::class);
