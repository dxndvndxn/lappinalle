<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SizesGetDataFromGenderController extends Controller
{
    public function index(Request $request, $number, $genders){
        // Получаем гендер id
        $sexId = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $genders)->get();
        $newGen = null;

        // Преобразовываем к обрабатываемомму виду
        foreach ($sexId as $val){
            $newGen = (array) $val;
        }

        // Преобразовываем строку в массив
        $productsId = explode(',', $number);

        $dataSizes = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newGen['sex_id'])
            ->orderBy('product_id', 'desc')
            ->whereIn('product_id',  $productsId)
            ->paginate(30);

        // Получаем мин стоимость
        $productMin =  DB::table('products')
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newGen['sex_id'])
            ->min('product_price');

        // Получаем макс стоимость
        $productMax =  DB::table('products')
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newGen['sex_id'])
            ->max('product_price');

        $dataSizes['max'] = $productMax;
        $dataSizes['min'] = $productMin;

        return $dataSizes;
    }
}
