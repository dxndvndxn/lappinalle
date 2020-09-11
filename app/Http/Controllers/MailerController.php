<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MailerController extends Controller
{
    protected function send(Request $request) {
        $dataMail = $request->all();
        $dataMail = json_decode($dataMail['mail'], TRUE);

        $mailer_name = $dataMail['mailer_name'];
        $mailer_email = $dataMail['mailer_email'];
        $mailer_text = $dataMail['mailer_text'];
        $mailer = 'Имя: '.$mailer_name.', E-mail: '.$mailer_email.', Текст: '.$mailer_text;

        Mail::raw($mailer, function($message)
        {
            $message->from(env('MAIL_USERNAME', ''), 'LAPPINALLE');
            $message->to('ilyanazimov@yandex.ru');
        });
    }
}
