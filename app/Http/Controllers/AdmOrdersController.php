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
            $orders_adm[$j][4] = $val['orders_created'];
            $orders_adm[$j][5] = $val['orders_status'];
            $j++;
        }

        return $orders_adm;
    }

    //Вывод информации по заказу по ID заказа
    public function order(Request $request){
        try{
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

//            return $korzina;
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
                $prod_size = $val[1];
                $prod_count = $val[2];
                $prod_name = (array)$prod_name[0];

                $korzina_adm[$i] = $prod_name['product_title'] . ', Размер:' . $prod_size . ', Количество: ' . $prod_count;
                $i++;
            }

            return $korzina_adm;
        }catch (Exception $e){
            return $e;
        }

    }

    //Смена статуса заказа
    public function status(Request $request) {

        $id = $request->only('id');
        $id = $id['id'];
        $status = $request->only('status');
        $status = $status['status'];

        DB::table('orders')
            ->where('orders_id', $id['id'])
            ->update(['orders_status' => $status['status']]);
    }
}
