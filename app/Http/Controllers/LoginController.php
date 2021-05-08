<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(LoginUserRequest $request)
    {

        if (!$token = guard()->attempt($request->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)

    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }


}

