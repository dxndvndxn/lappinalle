<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GiveMeCashMinMaxController extends Controller
{
    public function index(Request $request, $gender, $min, $max){

        // Получаем гендер id
        $sexId = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $gender)->get();
        $newArr = null;

        // Преобразовываем к обрабатываемомму виду
        foreach ($sexId as $val){
            $newArr = (array) $val;
        }

        $dataByGender = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_sale")
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newArr['sex_id'])
            ->whereBetween('product_price', [$min, $max])
            ->orderBy('product_id', 'desc')
            ->paginate(30);
        return $dataByGender;
    }
}
