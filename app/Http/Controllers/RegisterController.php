<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    //

    public function register(RegisterUserRequest $request)
    {
        $user = User::create(
            $request->validated(),
        );
        $user->setDefaultAvatar($user);

        return response()->json(['message' => $user]);

    }

    public function guard()
    {
        return Auth::guard('api');
    }
}
















