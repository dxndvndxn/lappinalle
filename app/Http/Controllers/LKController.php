<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class LKController extends Controller
{
    public function index(Request $request) {

        $token = $request->only('token');

        $dbdata = DB::table('LappiUsers')->where('LappiUsers_token', '=', $token)->get();

        $user = null;
        foreach ($dbdata as $val){
            $user = (array) $val;
        }

        $lkdata = [
            $user["LappiUsers_id"],
            $user["LappiUsers_name"],
            $user["LappiUsers_email"],
            $user["LappiUsers_tel"],
            $user["LappiUsers_sity"],
            $user["LappiUsers_street"],
            $user["LappiUsers_house"],
            $user["LappiUsers_corps"],
            $user["LappiUsers_apart"],
            $user["LappiUsers_ipost"]
        ];

        $dbord = DB::table('orders')->where('users_id', '=', $lkdata[0])->get();

        $orders = null;
        foreach ($dbord as $vol){
            $orders = (array) $vol;
        }

        $lkall = [$lkdata, $orders];

        return $lkall;
    }
    public function update(Request $request) {

        $token = $request->only('token');

        $dbdata = DB::table('LappiUsers')->where('LappiUsers_token', '=', $token)->get();

        $user = null;
        foreach ($dbdata as $val){
            $user = (array) $val;
        }

        $id = $user["LappiUsers_id"];

        $upd = $request->all();

        DB::table('LappiUsers')
            ->where('LappiUsers_id', $id)
            ->update(['LappiUsers_name' => $upd['name']]);

        DB::table('LappiUsers')
            ->where('LappiUsers_id', $id)
            ->update(['LappiUsers_email' => $upd['email']]);

        DB::table('LappiUsers')
            ->where('LappiUsers_id', $id)
            ->update(['LappiUsers_tel' => $upd['tel']]);

        DB::table('LappiUsers')
            ->where('LappiUsers_id', $id)
            ->update(['LappiUsers_sity' => $upd['sity']]);

        DB::table('LappiUsers')
            ->where('LappiUsers_id', $id)
            ->update(['LappiUsers_street' => $upd['street']]);

        DB::table('LappiUsers')
            ->where('LappiUsers_id', $id)
            ->update(['LappiUsers_house' => $upd['house']]);

        DB::table('LappiUsers')
            ->where('LappiUsers_id', $id)
            ->update(['LappiUsers_corps' => $upd['corps']]);

        DB::table('LappiUsers')
            ->where('LappiUsers_id', $id)
            ->update(['LappiUsers_apart' => $upd['apart']]);

        DB::table('LappiUsers')
            ->where('LappiUsers_id', $id)
            ->update(['LappiUsers_ipost' => $upd['ipost']]);

    }

    public function admin(Request $request) {

        $id = $request->only('id');

        $dbdata = DB::table('LappiUsers')->where('LappiUsers_id', '=', $id)->get();

        $user = null;
        foreach ($dbdata as $val){
            $user = (array) $val;
        }

        $lkdata = [
            $user["LappiUsers_id"],
            $user["LappiUsers_name"],
            $user["LappiUsers_email"],
            $user["LappiUsers_tel"],
            $user["LappiUsers_sity"],
            $user["LappiUsers_street"],
            $user["LappiUsers_house"],
            $user["LappiUsers_corps"],
            $user["LappiUsers_apart"],
            $user["LappiUsers_ipost"]
        ];

        $dbord = DB::table('orders')->where('users_id', '=', $id)->get();

        $orders = null;
        foreach ($dbord as $vol){
            $orders = (array) $vol;
        }

        $lkall = [$lkdata, $orders];

        return $lkall;
    }

}
