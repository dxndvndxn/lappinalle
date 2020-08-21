<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class GetDataFromGenderSortPriceController extends Controller
{
    public function index(Request $request, $where, $gender){
        // Получаем гендер id
        $sexId = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $gender)->get();
        $newArr = null;

        // Преобразовываем к обрабатываемомму виду
        foreach ($sexId as $val){
            $newArr = (array) $val;
        }

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

        switch ($where){
            case 'low':
                $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newArr['sex_id'])
                    ->orderBy('product_price', 'asc')
                    ->paginate(30);
                break;
            case 'high':
                $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newArr['sex_id'])
                    ->orderBy('product_price', 'desc')
                    ->paginate(30);
                break;
        }
        $sortData['min'] = $productMin;
        $sortData['max'] = $productMax;
        return $sortData;
    }
}
