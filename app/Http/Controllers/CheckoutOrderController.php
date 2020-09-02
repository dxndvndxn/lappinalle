<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CheckoutOrderController extends Controller
{
    public function index(Request $request){

        $order = $request->all();
        $name = $order[0]['customerData']['name'];
        $email = $order[0]['customerData']['email'];
        $tel = $order[0]['customerData']['tel'];
        $city = $order[0]['deliveryData']['city'];
        $street = $order[0]['deliveryData']['street'];
        $house = $order[0]['deliveryData']['house'];
        $apart = $order[0]['deliveryData']['apart'];
        $corps = $order[0]['deliveryData']['corps'];
        $deliveryName = $order[0]['deliveryData']['deliveryName'];
        $indexPost = $order[0]['deliveryData']['indexPost'];
        $korzina = '';
        $kor = count($order[0]['orderData']);
        $k = 0;
        while ($k < $kor) {
            $korzina.=$order[0]['orderData'][$k]['id'].','.$order[0]['orderData'][$k]['count'].','.$order[0]['orderData'][$k]['size'].','.$order[0]['orderData'][$k]['price'].'|';
            $k++;
        }

        $ordersend = DB::table('orders')->insert(
            [ 'orders_name' => $name,
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
                'orders_status' => 'В обработке'
            ]
        );

        if ($ordersend) {
            return true;
        }
        else {
            return false;
        }
    }
}
