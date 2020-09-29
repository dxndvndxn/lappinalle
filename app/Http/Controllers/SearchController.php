<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {

        $s = $request->only('search');
        $s = $s['search'];

        $data = DB::table('products')->where('product_title', 'LIKE', "%".$s."%")->select("product_id","product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')->get();
        return $data;

    }
}
