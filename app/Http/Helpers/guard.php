<?php

use Illuminate\Support\Facades\Auth;

function guard()
{
    return Auth::guard('api');
}

?>
