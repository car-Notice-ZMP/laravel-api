<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class MailService
{
    private $receiver;

    public function send($title, $content, $receiver)
    {
        $this->receiver = $receiver;

        $data = [
            'title'   => $title,
            'content' => $content
        ];

        Mail::send('emails.email', $data, function($message)
        {
            $message->to($this->receiver, 'NoticeMyCar')->subject('NoticeMyCar');
        });
    }
}


















