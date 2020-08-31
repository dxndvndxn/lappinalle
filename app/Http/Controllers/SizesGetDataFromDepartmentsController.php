<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SizesGetDataFromDepartmentsController extends Controller
{
    public function index(Request $request, $number, $genders, $categories, $departments){

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

        // Узнаем какие подкатегории нужны
        $departmentsId = DB::table('departments')->select("departments_id")->where('departments_alias', '=', $departments)->get();
        $newDepart = null;

        foreach ($departmentsId as $val) {
            $newDepart = (array)$val;
        }

        // Преобразовываем строку в массив
        $productsId = explode(',', $number);

        $dataSizes = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newGen['sex_id'])
            ->where('categories_id', '=', $newCateg['categories_id'])
            ->where('departments_id', '=', $newDepart['departments_id'])
            ->orderBy('product_id', 'desc')
            ->whereIn('product_id',  $productsId)
            ->paginate(30);

        // Получаем мин стоимость
        $productMin =  DB::table('products')
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newGen['sex_id'])
            ->where('categories_id', '=', $newCateg['categories_id'])
            ->where('departments_id', '=', $newDepart['departments_id'])
            ->min('product_price');

        // Получаем макс стоимость
        $productMax =  DB::table('products')
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newGen['sex_id'])
            ->where('departments_id', '=', $newDepart['departments_id'])
            ->where('categories_id', '=', $newCateg['categories_id'])
            ->max('product_price');

        $dataSizes['max'] = $productMax;
        $dataSizes['min'] = $productMin;

        return $dataSizes;
    }
}
