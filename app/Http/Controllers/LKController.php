<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Exception;

class LKController extends Controller
{
    public function index(Request $request) {
        $data = $request->all();
        $token = json_decode($data['token'], true);
        $dbdata = DB::table('lappiusers')->where('lappiusers_token', '=', $token)->get();

        $user = null;
        foreach ($dbdata as $val){
            $user = (array) $val;
        }

        $lkdata = [
            $user["lappiusers_id"],
            $user["lappiusers_name"],
            $user["lappiusers_email"],
            $user["lappiusers_tel"],
            $user["lappiusers_sity"],
            $user["lappiusers_street"],
            $user["lappiusers_house"],
            $user["lappiusers_corps"],
            $user["lappiusers_apart"],
            $user["lappiusers_ipost"]
        ];

        $orders = DB::table('orders')->select('orders_id', "orders_status", 'orders_korzina', 'orders_totalPrice', 'orders_deliveryName')->where('lappiusers_id', '=', $lkdata[0])->get();

        $wrapOrder = [];

        // Обрабатываем заказы пользователя
        foreach ($orders as $i => $val) {

            // Делаем обертку
            $localArr = (array) $val;

            //Пушим обертку в новый массив
            array_push( $wrapOrder, $localArr);

            // Разделяем коризну по знаку
            $localCart = explode('|', $localArr['orders_korzina']);

            // Если пустое значение, то вырезаем
            if (array_pop($localCart) === "") array_slice($localCart, 1, -1);

            $newCart = null;
            $wrapOrder[$i]['orders_korzina'] = [];
            $wrapOrder[$i]['active'] = false;
            foreach ($localCart as $cartVal) {

                // Разделяем на корзину по запятой
                $splashCart = explode(',', $cartVal);

                // Запрос к бд на товар
                $product = DB::table('products')->where('product_id', $splashCart[0])->select('product_title', 'product_price', 'product_img')->get();
                $productWrap = [];

                // Делаем обертку
                foreach ($product as $prdVal) {
                    $localProductArr = (array) $prdVal;
                    $imgCart = explode(',', $localProductArr['product_img']);

                    // Массив с данным о заказах
                    array_push($wrapOrder[$i]['orders_korzina'], [$localProductArr['product_title'], $splashCart[1], $splashCart[2], $splashCart[3], $imgCart[0]]);
                }
            }
        }

        $lkall = [$lkdata, $wrapOrder];

        return $lkall;
    }

    public function update(Request $request) {
        try{
            $upd = $request->all();
            $upd = json_decode($upd['userUpdate'], true);

            $dbdata = DB::table('lappiusers')->where('lappiusers_token', '=', $upd['token'])->get();

            $user = null;
            foreach ($dbdata as $val){
                $user = (array) $val;
            }

            $id = $user["lappiusers_id"];

            DB::table('lappiusers')
                ->where('lappiusers_id', $id)
                ->update(['lappiusers_name' => $upd['userName']]);

            DB::table('lappiusers')
                ->where('lappiusers_id', $id)
                ->update(['lappiusers_email' => $upd['userEmail']]);

            DB::table('lappiusers')
                ->where('lappiusers_id', $id)
                ->update(['lappiusers_tel' => $upd['userTel']]);

            DB::table('lappiusers')
                ->where('lappiusers_id', $id)
                ->update(['lappiusers_sity' => $upd['userCity']]);

            DB::table('lappiusers')
                ->where('lappiusers_id', $id)
                ->update(['lappiusers_street' => $upd['userAdrr']]);

            DB::table('lappiusers')
                ->where('lappiusers_id', $id)
                ->update(['lappiusers_house' => $upd['userBuild']]);

            DB::table('lappiusers')
                ->where('lappiusers_id', $id)
                ->update(['lappiusers_corps' => $upd['userCorpus']]);

            DB::table('lappiusers')
                ->where('lappiusers_id', $id)
                ->update(['lappiusers_apart' => $upd['userApart']]);

            DB::table('lappiusers')
                ->where('lappiusers_id', $id)
                ->update(['lappiusers_ipost' => $upd['userPostI']]);

            if ($upd['userNewPass'] !== null) {
                $hpass = password_hash($upd['userNewPass'], PASSWORD_DEFAULT);
                DB::table('lappiusers')
                    ->where('lappiusers_id', $id)
                    ->update(['lappiusers_password' => $hpass]);
            }

            return 'Yes';
        }catch (Exception $e){
            return $e;
        }

    }

    public function admin(Request $request) {
        $id = $request->only('id');

        $dbdata = DB::table('lappiusers')->where('lappiusers_id', '=', $id)->get();

        $user = null;
        foreach ($dbdata as $val){
            $user = (array) $val;
        }

        $lkdata = [
            $user["lappiusers_name"],
            $user["lappiusers_email"],
            $user["lappiusers_tel"],
            $user["lappiusers_sity"],
            $user["lappiusers_street"],
            $user["lappiusers_house"],
            $user["lappiusers_corps"],
            $user["lappiusers_apart"],
            $user["lappiusers_ipost"]
        ];

        // Получаем все заказы у конкретного юзера
        $order = DB::table('orders')->select('orders_id')->where('lappiusers_id', '=', $id)->get();

        $ordersId = [];

        // Получакм корзину конкретного юзера
        foreach ($order as $val) {
            $localArr = (array) $val;
            array_push($ordersId, $localArr['orders_id']);
        }

        $lkall = [$lkdata, $ordersId];

        return $lkall;
    }

    public function CheckPass(Request $request) {
        $data = $request->all();
        $checkData = json_decode($data['check'], true);
        $selectData = DB::table('lappiusers')->select('lappiusers_password')->where('lappiusers_token', '=', $checkData['token'])->get();

        $checkPass = null;
        foreach ($selectData as $val){
            $checkPass = (array) $val;
        }
        $vpas = password_verify($checkData['password'], $checkPass["lappiusers_password"]);

        if ($vpas) {
            return true;
        }else{
            return false;
        }
    }

    public function adminIn(Request $request) {
        $fromFront = $request->all();
        if (isset($fromFront['login'])){
            $user = $fromFront['login'];
            $pass = $fromFront['pass'];
            $vpas = password_verify($pass, '$2y$10$py6DuxLJEetC5oxv6yopVeZzE7OnPTnxKagnyGUU28N1UNL7Zh2Wq');

            if ($user === "lappiadmin" && $vpas) {
                return "127.0.0.1";
            }else{
                return false;
            }
        }
        if (isset($fromFront['check'])){
            if ($fromFront['check'] === "127.0.0.1") {
                return true;
            }else{
                return false;
            }
        }
    }
}
