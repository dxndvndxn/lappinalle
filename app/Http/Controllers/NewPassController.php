<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Exception;

class NewPassController extends Controller
{

    public function gen_pass()
    {
        $pass = sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
        return $pass;
    }

    public function newpass(Request $request)
    {
        try {
            $email = $request->all();
            $email = $email['email'];

            $password = $this->gen_pass();
            $hpass = password_hash($password, PASSWORD_DEFAULT);

            DB::table('lappiusers')->where('lappiusers_email', $email)->update(['lappiusers_password' => $hpass]);

            $mailer = 'Новый пароль: ' . $password;
            $headers = 'From: no-reply@lappinalle.ru';

            mail($email, "LAPPINALLE: ВОССТАНОВЛЕНИЕ ПАРОЛЯ", $mailer, $headers);

            return true;
        }catch (Exception $e){
            return $e;
        }
    }
}
