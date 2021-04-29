<?php

use Illuminate\Support\Facades\Auth;

function guard()
{
    return Auth::guard('api');
}

function checkAuthor ($user, $notice)
{
    if($user !== $notice)
    {
        abort(401, 'Nie posiadasz odpowiednich uprawnień');
    }
}

function checkAdmin($user)
{
    if($user->admin === 0)
    {
        abort(401, 'Nie posiadasz uprawnień administratora');
    }
}




?>
