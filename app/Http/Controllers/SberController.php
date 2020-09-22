<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SberController extends Controller
{
    public function sber(Request $request) {

        $data = $request->all();

        try {
            $data = $request->all();
            $decodeData = json_decode($data['data'], TRUE);
            $vars['userName'] = 'lappinalle-api';
            $vars['password'] = 'lappinalle';
            $lastIdOrder = DB::table('orders')->select('orders_id')->orderBy('orders_id', 'desc')->value('orders_id');
            $vars['orderNumber'] = ++$lastIdOrder;
            $vars['amount'] = $decodeData['amount'] * 100;
            $vars['returnUrl'] = 'https://lappinalle.ru/paysuccess';
            $vars['failUrl'] = 'https://lappinalle.ru';

            $ch = curl_init('https://3dsec.sberbank.ru/payment/rest/register.do?' . http_build_query($vars));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $res = curl_exec($ch);
            curl_close($ch);
            $res = json_decode($res, JSON_OBJECT_AS_ARRAY);
//            if (empty($res['orderId'])){
//                echo $res['errorMessage'];
//            } else {
//                header('Location: ' . $res['formUrl'], true);
//            }
//            header("Location: " . $res['formUrl'], true);
            return $res;
        }catch (\Exception $e){
            return  $e;
        }


    }
}
