<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Carbon;

class CheckoutOrderController extends Controller
{
    public function index(Request $request){

        $order = $request->all();
        $name = $order[0]['customerData']['name'];
        $email = $order[0]['customerData']['email'];
        $tel = $order[0]['customerData']['tel'];
        $token = $order[0]['customerData']['token'];
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

        $ordersend = DB::table('orders')->insert(
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
                'orders_status' => 'В обработке',
                'orders_passportData' => $passportData,
                'orders_whereGet' =>  $whereGet,
                'orders_totalPrice' => $totalPrice,
                'orders_Comment' => $comment,
                'created_at' => Carbon::now(),
            ]
        );
        if ($ordersend) {
            return DB::table('orders')->select('orders_id')->orderBy('orders_id', 'desc')->value('orders_id');
        } else {
            return false;
        }
    }
}
