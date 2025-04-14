<?php

use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\PortfolioController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Middleware\CommenterAuth;

Route::get('/', [PortfolioController::class, 'index']);


// comment routing
Route::resource('comments', CommentController::class)->middleware(
    CommenterAuth::class
);

// google OAuth routing
Route::get('login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);


Route::post('logout', [CommentController::class, 'logout'])->name('logout');