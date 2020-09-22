<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ChangeStatusOrderController extends Controller
{
    public function index(Request $request) {
        try {
            $order = $request->all();
            $decodeOrder = json_decode($order['data'], TRUE);
            $name = $decodeOrder[0]['customerData']['name'];
            $email = $decodeOrder[0]['customerData']['email'];
            $tel = $decodeOrder[0]['customerData']['tel'];
            $totalPrice = DB::table('orders')->where('orders_id', '=', $decodeOrder[0]['id'])->select('orders_totalPrice')->value('orders_totalPrice');

            $orderStatus = DB::table('orders')->where('orders_id', '=', (int)$decodeOrder[0]['id'])->update(['orders_status' => 'В обработке']);
            $y = 0;
            $tovar = [NULL];
            foreach ($decodeOrder[0]['orderData'] as $val) {
                $tovar[$y][0] = DB::table('products')->where(['product_id' => $val['id']])->select('product_title')->value('product_title');
                $tovar[$y][1] = $val['size'];
                $tovar[$y][2] = $val['count'];
                $y++;
            }

            $mailer = "Вы совершили покупку в интернет-магазине Lappinalle.ru \n Корзина: ";

            foreach ($tovar as $val) {
                $mailer .= $val[0] . ', размер ' . $val[1] . ', ' . $val[2] . "шт. \n";
            }

            $mailer .= 'Общая стоимость: ' . $totalPrice;

            $headers = 'From: no-reply@lappinalle.ru';

            mail($email, "LAPPINALLE: ЗАКАЗ №".$decodeOrder[0]['id'], $mailer, $headers);

            $maileradm = "$name, $email, $tel \n Корзина: ";

            foreach ($tovar as $val) {
                $maileradm .= $val[0] . ', размер ' . $val[1] . ', ' . $val[2] . "шт. \n";
            }

            $maileradm .= 'Общая стоимость: ' . $totalPrice;

            mail('info@lappinalle.ru', "LAPPINALLE: ЗАКАЗ №".$decodeOrder[0]['id'], $maileradm, $headers);
            return true;
        }catch (\Exception $e){
            return $e;
        }

    }
}
