<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Carbon;

class SberController extends Controller
{
    public function sber(Request $request) {

        try {
        $order = $request->all();
        $order = json_decode($order['data'], TRUE);

        $name = $order[0]['customerData']['name'];
        $email = $order[0]['customerData']['email'];
        $tel = $order[0]['customerData']['tel'];
        $token = $order[0]['customerData']['token'];
        $paymentName = $order[0]['customerData']['paymentName'];
        $city = $order[0]['deliveryData']['city'];
        $street = $order[0]['deliveryData']['street'];
        $house = $order[0]['deliveryData']['house'];
        $apart = $order[0]['deliveryData']['apart'];
        $corps = $order[0]['deliveryData']['corps'];
        $passportData = $order[0]['deliveryData']['passportData'];
        $whereGet = $order[0]['deliveryData']['whereGet'];
        $deliveryName = $order[0]['deliveryData']['deliveryName'];
        $indexPost = $order[0]['deliveryData']['indexPost'];
        $comment = $order[0]['deliveryData']['comment'];
        $totalPrice = $order[0]['totalPrice'];
        $korzina = '';
        $kor = count($order[0]['orderData']);
        $k = 0;

        // ID юзера
        $id = NULL ?? DB::table('lappiusers')->select('lappiusers_id')->where('lappiusers_token', '=', $token)->value('lappiusers_id');

        while ($k < $kor) {
            $korzina.= $order[0]['orderData'][$k]['id'].','.$order[0]['orderData'][$k]['count'].','.$order[0]['orderData'][$k]['size'].','.$order[0]['orderData'][$k]['price'].'|';
            $k++;
        }

        DB::table('orders')->insert(
            [
                'lappiusers_id' => $id,
                'orders_name' => $name,
                'orders_email' => $email,
                'orders_tel' => $tel,
                'orders_city' => $city,
                'orders_street' => $street,
                'orders_house' => $house,
                'orders_apart' => $apart,
                'orders_corps' => $corps,
                'orders_deliveryName' => $deliveryName,
                'orders_indexPost' => $indexPost,
                'orders_korzina' => $korzina,
                'orders_status' => 'Не оплачен',
                'orders_passportData' => $passportData,
                'orders_whereGet' =>  $whereGet,
                'orders_totalPrice' => $totalPrice,
                'orders_Comment' => $comment,
                'orders_payment' => $paymentName,
                'created_at' => Carbon::now()
            ]
        );

            $vars['userName'] = 'lappinalle-api';
            $vars['password'] = 'lappinalle';
            $lastIdOrder = DB::table('orders')->select('orders_id')->orderBy('orders_id', 'desc')->value('orders_id');
            $vars['orderNumber'] = $lastIdOrder;
            $vars['amount'] = $order[1]['amount'] * 100;
            $vars['returnUrl'] = 'https://lappinalle.ru/paysuccess';
            $vars['failUrl'] = 'https://lappinalle.ru/payfail';

            $ch = curl_init('https://3dsec.sberbank.ru/payment/rest/register.do?' . http_build_query($vars));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $res = curl_exec($ch);
            curl_close($ch);
            $res = json_decode($res, JSON_OBJECT_AS_ARRAY);
            $res['id'] = $lastIdOrder;
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
