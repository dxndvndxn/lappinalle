<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class DelController extends Controller
{
    public function admin(Request $request) {

        $deldata = $request->only('id');

        $con = DB::table('delivery')->where('delivery_id', '=', $deldata)->select('delivery_confirm')->value('delivery_confirm');

        if ($con) {
            DB::table('delivery')
                ->where('delivery_id', $deldata)
                ->update(['delivery_confirm' => 0]);
        }else{
            DB::table('delivery')
                ->where('delivery_id', $deldata)
                ->update(['delivery_confirm' => 1]);
        }
    }

    public function site(Request $request) {
        $deliveries = DB::table('delivery')->get();
        return $deliveries;
    }
}
