<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class AdmOrdersController extends Controller
{

//Вывод информации по всем заказам
    public function all(Request $request){

        $dborders = DB::table('orders')->get();

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

        $id = $request->only('id');

        $a = DB::table('orders')->where('orders_id', $id['id'])->get();

        $order = [null];
        $i=0;

        //Убираем лишнюю обёртку массива
        foreach ($a as $val){
            $order[$i] = (array) $val;
            $i++;
        }

        return $order[0];

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
