<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SizesGetDataFromCategoriesController extends Controller
{
    public function index(Request $request, $number, $genders, $categories){
        // Находим в категориях тире (aksessuari-vesnaosen) и разделяем его на (aksessuari, vesnaosen)
        $regxp = '/(-)/';
        $parts = preg_split($regxp, $categories);

        // Узнаем какой гендер нужен
        $sexId = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $genders)->get();
        $newGen = null;

        foreach ($sexId as $val){
            $newGen = (array) $val;
        }

        // Узнаем какие категория нужна
        $categoryId = DB::table('categories')->select("categories_id")->where('categories_alias', '=', $categories)->get();
        $newCateg = null;

        foreach ($categoryId as $val){
            $newCateg = (array) $val;
        }

        // Преобразовываем строку в массив
        $productsId = explode(',', $number);

        $dataSizes = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newGen['sex_id'])
            ->where('categories_id', '=', $newCateg['categories_id'])
            ->orderBy('product_id', 'desc')
            ->whereIn('product_id',  $productsId)
            ->paginate(30);

        // Получаем мин стоимость
        $productMin =  DB::table('products')
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newGen['sex_id'])
            ->where('categories_id', '=', $newCateg['categories_id'])
            ->min('product_price');

        // Получаем макс стоимость
        $productMax =  DB::table('products')
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newGen['sex_id'])
            ->where('categories_id', '=', $newCateg['categories_id'])
            ->max('product_price');

        $dataSizes['eu'] = (int)GetEUController::EU();
        $dataSizes['max'] = $productMax * (int)GetEUController::EU();
        $dataSizes['min'] = $productMin * (int)GetEUController::EU();

        return $dataSizes;
    }
}
