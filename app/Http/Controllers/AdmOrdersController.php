<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Exception;
class AdmOrdersController extends Controller
{

//Вывод информации по всем заказам
    public function all(Request $request){

        $dborders = DB::table('orders')->orderBy('orders_id', 'desc')->get();

        if (!count($dborders)){
            return false;
        }

        $orders = [null];
        $i=0;
        $j=0;

        //Убираем обёртку массива
        foreach ($dborders as $val){
            $orders[$i] = (array) $val;
            $i++;
        }

        $orders_adm = [null];

        //Вывод двумерного массива с ID, ФИО, телефоном, почтой, датой и статусом всех заказов
        foreach ($orders as $val){
            $orders_adm[$j][0] = $val['orders_id'];
            $orders_adm[$j][1] = $val['orders_name'];
            $orders_adm[$j][2] = $val['orders_tel'];
            $orders_adm[$j][3] = $val['orders_email'];
            $orders_adm[$j][4] = $val['created_at'];
            $orders_adm[$j][5] = $val['orders_status'];
            $j++;
        }

        return $orders_adm;
    }

    //Вывод информации по заказу по ID заказа
    public function order(Request $request){
        $data = $request->all();
        $id = json_decode($data['id'], true);


        $a = DB::table('orders')->where('orders_id', $id)->get();

        $order = [null];
        $i=0;

        //Убираем лишнюю обёртку массива
        foreach ($a as $val){
            $order[$i] = (array) $val;
            $i++;
        }

        $i = 0;
        $korzina = explode('|', $order[0]['orders_korzina']);

        foreach ($korzina as $val) {
            $korzina[$i] = explode(',', $val);
            $i++;
        }
        //На этом моменте получается массив вида [['1', '46', '1', '2000']['1', '48', '1', '2000']]

        $i = 0;
        $korzina_adm = [NULL];

        foreach ($korzina as $val) {
            if ($val[0] === "") break;
            $prod_name = DB::table('products')->where('product_id', $val[0])->select('product_title')->get();
            $prod_size = $val[2] === '' ? 'Нет' : $val[2];
            $prod_count = $val[1];
            $prod_name = (array)$prod_name[0];

            $korzina_adm[$i] = 'ID товара: ' . $val[0] .', '. $prod_name['product_title'] . ', Размер: ' . $prod_size . ', Количество: ' . $prod_count;
            $i++;
        }
        $totalOrder = [];

        array_push($totalOrder, $a);
        array_push($totalOrder, $korzina_adm);
        return $totalOrder;

    }

    //Смена статуса заказа
    public function status(Request $request) {

        $id = $request->only('id');
        $id = $id['id'];
        $status = $request->only('status');
        $status = $status['status'];
        DB::table('orders')
            ->where('orders_id', $id)
            ->update(['orders_status' => $status]);
    }
//    public function red(Request $request) {
//
//        $prod_id = $request->only('product_id');
//        $size = $request->only('size');
//        $amount = $request->only('amount');
//        $order_id = $request->only('order_id');
//
//        $size_id = DB::table('sizes')->where('sizes_number', $size['size'])->value('sizes_id');
//
//        DB::table('catalog_sizes')->where([
//            ['sizes_id', $size_id],
//            ['product_id', $prod_id['product_id']]
//        ])->increment('catalog_sizes_amount', $amount);
//
//        $korzina = DB::table('orders')->where('orders_id', $order_id['order_id'])->value('orders_korzina');
//        $korzina = explode('|', $korzina);
//        foreach($korzina as $val) {
//            $pi = $prod_id['product_id'];
//            $am = $amount['amount'];
//            $s = $size['size'];
//            $v = strpos((string)$val, "$pi,$am,$s");
//
//            if ($v !== false) {
//                unset($val);
//            }
//        }
//
//        $newkor = '';
//        foreach ($korzina as $val) {
//            $newkor.=$val."|";
//        }
//
//        DB::table('orders')->where('orders_id', $order_id['order_id'])->update('orders_korzina', $newkor);
//    }
    public function red(Request $request) {
//        try {
//            $fromFront = $request->all();
//            $prod_id = $fromFront['product_id'];
//            $size = $fromFront['size'];
//            $amount = $fromFront['amount'];
//            $order_id = $fromFront['order_id'];
//
//            $size_id = DB::table('sizes')->where('sizes_number', $size['size'])->value('sizes_id');
//
//            DB::table('catalog_sizes')->where([
//                ['sizes_id', $size_id],
//                ['product_id', $prod_id['product_id']]
//            ])->increment('catalog_sizes_amount', $amount);
//
//            $korzina = DB::table('orders')->where('orders_id', $order_id['order_id'])->value('orders_korzina');
//            $korzina = explode('|', $korzina);
//            foreach($korzina as $val) {
//                $v1 = strpos($val, $prod_id);
//                if ($v1 !== false) {
//                    $v1 = strpos($val, $size);
//                    if ($v1 !== false) {
//                        unset($val);
//                    }
//                }
//            }
//
//            $newkor = '';
//            foreach ($korzina as $val) {
//                $newkor.=$val."|";
//            }
//
//            DB::table('orders')->where('orders_id', $order_id['order_id'])->update('orders_korzina', $newkor);
//            return true;
//        }catch (Exception $e) {
//            return $e;
//        }
        try {
            $prod_id = $request->only('product_id');
            $size = $request->only('size');
            $amount = $request->only('amount');
            $order_id = $request->only('order_id');

            $size_id = DB::table('sizes')->where('sizes_number', $size['size'])->value('sizes_id');

            DB::table('catalog_size')->where([
                ['sizes_id', $size_id],
                ['product_id', $prod_id['product_id']]
            ])->increment('catalog_size_amount', (int)$amount);

            $korzina = DB::table('orders')->where('orders_id', $order_id['order_id'])->value('orders_korzina');

            $korzina = explode('|', $korzina);

            foreach($korzina as $i => $val) {
                $pi = $prod_id['product_id'];
                $am = $amount['amount'];
                $s = $size['size'];
                $v = strpos((string)$val, (string)"$pi,$am,$s");

                if ($v !== false) {
                    unset($korzina[$i]);
                }
                if ($val === ""){
                    unset($korzina[$i]);
                }
            }

            $newkor = '';
            foreach ($korzina as $val) {
                $newkor.=$val."|";
            }

            DB::table('orders')->where('orders_id', $order_id['order_id'])->update(['orders_korzina' => $newkor]);
            return true;
        }catch (Exception $e){
            return $e;
        }

    }
}
