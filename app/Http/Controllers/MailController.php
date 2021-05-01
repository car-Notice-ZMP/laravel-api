<?php

namespace App\Http\Controllers;

use App\Services\MailService;
use App\Http\Requests\SendEmailRequest;

class MailController extends Controller
{
    public function send(SendEmailRequest $request)
    {
        $user = auth()->user();

        $mail = new MailService();

        $mail->send($request, $user);

        return response()->json(['message'=> 'Udało się wysłać maila']);
    }
}
