<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GiveMeCashMinMaxByGenderController extends Controller
{
    public function index(Request $request, $gender, $min, $max){

        // Получаем гендер id
        $sexId = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $gender)->get();
        $newGen = null;

        // Преобразовываем к обрабатываемомму виду
        foreach ($sexId as $val){
            $newGen = (array) $val;
        }

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

        $dataByGender = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newGen['sex_id'])
            ->whereBetween('product_price', [$min, $max])
            ->orderBy('product_id', 'desc')
            ->paginate(30);

        $dataSizes = DB::table('catalog_size')
            ->join('products', 'catalog_size.product_id', '=', 'products.product_id')->select('sizes_number', 'products.product_id')
            ->join('sizes', 'catalog_size.sizes_id', '=', 'sizes.sizes_id')
            ->where('sex_id', '=', $newGen['sex_id'])
            ->whereBetween('product_price', [$min, $max])
            ->get();

        $dataByGender['max'] = $productMax;
        $dataByGender['min'] = $productMin;
        $dataByGender['sizes'] = $dataSizes;

        return $dataByGender;
    }
}
