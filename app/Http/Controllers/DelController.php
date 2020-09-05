<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class DelController extends Controller
{
    public function admin(Request $request) {

        $deldata = $request->all();

        foreach ($deldata as $val) {

            $con = DB::table('delivery')->where('delivery_id', '=', $val)->select('confirm')->get();

            if ($con == true) {
                DB::table('delivery')
                    ->where('delivery_id', $val)
                    ->update(['confirm' => false]);
            }else{
                DB::table('delivery')
                    ->where('delivery_id', $val)
                    ->update(['confirm' => true]);
            }
        }
    }

    public function site(Request $request) {

        $d1 = DB::table('delivery')->where('delivery_id', '=', 1)->select('confirm')->get();
        $d2 = DB::table('delivery')->where('delivery_id', '=', 2)->select('confirm')->get();
        $d3 = DB::table('delivery')->where('delivery_id', '=', 3)->select('confirm')->get();
        $d4 = DB::table('delivery')->where('delivery_id', '=', 4)->select('confirm')->get();

        $delconfirms = [
            [1, 'Курьерская доставка', $d1],
            [2, 'Почта России', $d2],
            [3, 'СДЭК', $d3],
            [4, 'ПЭК', $d4]
        ];

        return $delconfirms;
    }
}
