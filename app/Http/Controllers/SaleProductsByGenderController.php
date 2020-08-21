<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SaleProductsByGenderController extends Controller
{
    public function index(Request $request, $gender){
        // Получаем гендер id
        $sexId = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $gender)->get();
        $newArr = null;

        // Преобразовываем к обрабатываемомму виду
        foreach ($sexId as $val){
            $newArr = (array) $val;
        }

        $dataSale = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newArr['sex_id'])
            ->where('product_sale', '=', 1)
            ->orderBy('product_id', 'desc')
            ->paginate(30);

        // Получаем мин стоимость
        $productMin =  DB::table('products')
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newArr['sex_id'])
            ->min('product_price');

        // Получаем макс стоимость
        $productMax =  DB::table('products')
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newArr['sex_id'])
            ->max('product_price');

        $dataSale['min'] = $productMin;
        $dataSale['max'] = $productMax;

        return $dataSale;
    }
}
