<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function profile()
    {
        return response()->json(['message' => $this->guard()->user()], 200, [],JSON_UNESCAPED_SLASHES);
    }

    public function guard()
    {
        return Auth::guard('api');
    }
}
