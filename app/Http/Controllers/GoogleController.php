<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use JWTAuth;

class GoogleController extends Controller
{
    //

    public function redirectToGoogle() {
        return Socialite::driver('google')->stateless()->redirect();

    }

    public function handleGoogleCallback() {

        $user =  Socialite::driver('google')->stateless()->user();

        $name           = $user->getName();
        $avatar         = $user->getAvatar();
        $email          = $user->getEmail();


        $user = User::where([
            'name'           => $name,
            'email'          => $email,
            'avatar'         => $avatar,
        ])->first();


        $user = User::firstOrCreate([
            'name'           => $name,
            'email'          => $email,
            'avatar'         => $avatar,
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'access_token'   => $token,
            'name'           => $name,
            'email'          => $email,
            'avatar'         => $avatar,
        ]);
    }
}
