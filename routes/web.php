<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\MustBeLoggedIn;
use Illuminate\Support\Facades\Route;

// User routes
Route::get('/', [UserController::class, 'showCorrectPage']);
Route::post('register', [UserController::class, 'register'])->middleware('guest');
Route::post('login', [UserController::class, 'login'])->middleware('guest');
Route::post('logout', [UserController::class, 'logout'])->middleware(MustBeLoggedIn::class);

// Post routes
Route::get('create-post', [PostController::class, 'showCreatePostForm'])->middleware(MustBeLoggedIn::class);
Route::post('create-post', [PostController::class, 'storePost'])->middleware(MustBeLoggedIn::class);
Route::get('post/{post}', [PostController::class, 'showSinglePost']);