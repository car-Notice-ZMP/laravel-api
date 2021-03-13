<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    //

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        $user =  Socialite::driver('google')->stateless()->user();

        $user_model = new User;
        $google_user = $user_model->googleCallback($user);

        return response()->json(['google_user' => $google_user ]);
    }
}
