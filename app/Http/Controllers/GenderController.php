<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GenderController extends Controller
{
    public function index(Request $request, $genders){
        // Получаем гендер id
        $sexId = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $genders)->get();
        $newArr = null;

        foreach ($sexId as $val){
            $newArr = (array) $val;
        }
        $dataByGender = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_sale")
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newArr['sex_id'])
            ->get();
        return $dataByGender;
    }
}
