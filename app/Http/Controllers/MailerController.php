<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MailerController extends Controller
{
    protected function send(Request $request) {

        $mailer_name = $request->only('mailer_name');
        $mailer_email = $request->only('mailer_email');
        $mailer_text = $request->only('mailer_text');
        $mailer = 'Имя: '.$mailer_name['mailer_name'].', E-mail: '.$mailer_email['mailer_email'].', Текст: '.$mailer_text['mailer_text'];

        Mail::raw($mailer, function($message)
        {
            $message->from(env('MAIL_USERNAME', ''), 'LAPPINALLE');
            $message->to('ilyanazimov@yandex.ru');
        });
    }
}
