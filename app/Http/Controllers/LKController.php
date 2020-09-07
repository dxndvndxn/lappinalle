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

        $dbord = DB::table('orders')->where('lappiusers_id', '=', $lkdata[0])->get();

        $orders = null;
        foreach ($dbord as $vol){
            $orders = (array) $vol;
        }

        $lkall = [$lkdata, $orders];

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

        $dbord = DB::table('orders')->where('lappiusers_id', '=', $id)->get();

        $orders = null;
        foreach ($dbord as $vol){
            $orders = (array) $vol;
        }

        $lkall = [$lkdata, $orders];

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
}
