<?php

namespace App\Services;

use App\Http\Requests\SendEmailRequest;
use Illuminate\Support\Facades\Mail;

class MailService
{
    private $receiver;

    public function send(SendEmailRequest $request, $user)
    {
        checkAdmin($user);

        $title    = $request->title;
        $content  = $request->content;
        $receiver = $request->receiver;

        $this->receiver = $receiver;

        $data = [
            'title'   => $title,
            'content' => $content
        ];

        Mail::send('email', $data, function($message)
        {
            $message->to($this->receiver, 'NoticeMyCar')->subject('NoticeMyCar');
        });
    }
}


















