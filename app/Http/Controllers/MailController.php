<?php

namespace App\Http\Controllers;

use App\Services\MailService;
use App\Http\Requests\SendEmailRequest;

class MailController extends Controller
{
    public function sent(SendEmailRequest $request)
    {
        $title    = $request->title;
        $content  = $request->content;
        $receiver = $request->receiver;

        $mail = new MailService();

        $mail->send($title, $content, $receiver);

        return response()->json(['message'=> 'Udało się wysłać maila']);
    }
}
