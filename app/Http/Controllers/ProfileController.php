<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function profile()
    {
        return response()->json($this->guard()->user());
    }

    public function guard()
    {
        return Auth::guard('api');
    }
}
