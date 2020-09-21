<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SberController extends Controller
{
    public function sber(Request $request) {

        $data = $request->all();

        try {
            $data = $request->all();
            $decodeData = json_decode($data['data'], TRUE);
            $vars['userName'] = 'lappinalle-api';
            $vars['password'] = 'lappinalle';
            $vars['orderNumber'] = $decodeData['orderNumber'];
            $vars['amount'] = $decodeData['amount'];
            $vars['returnUrl'] = 'https://lappinalle.ru/paysuccess';
            $vars['failUrl'] = 'https://lappinalle.ru';

            $ch = curl_init('https://3dsec.sberbank.ru/payment/rest/register.do?' . http_build_query($vars));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $res = curl_exec($ch);
            curl_close($ch);

            return $res;
        }catch (\Exception $e){
            return  $e;
        }


    }
}
