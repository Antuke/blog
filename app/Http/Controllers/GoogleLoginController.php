<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Commenter;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $commenter = Commenter::where('google_id', $googleUser->id)->first();

            if (!$commenter) {
                
                $commenter = Commenter::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                ]);
            }
            

            // Store commenter data in session instead of full auth
            session(['commenter_id' => $commenter->id]);
            
            return redirect()->intended('/');
            
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Google authentication failed');
        }
    }
}