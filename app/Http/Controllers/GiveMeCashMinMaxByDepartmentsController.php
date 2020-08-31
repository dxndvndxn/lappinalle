<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GiveMeCashMinMaxByDepartmentsController extends Controller
{
    public function index(Request $request, $gender, $categories, $departments, $min, $max){

        // Узнаем какой гендер нужен
        $sexId = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $gender)->get();
        $newGen = null;

        foreach ($sexId as $val) {
            $newGen = (array)$val;
        }

        // Узнаем какие категории нужны
        $categoryId = DB::table('categories')->select("categories_id")->where('categories_alias', '=', $categories)->get();
        $newCateg = null;

        foreach ($categoryId as $val) {
            $newCateg = (array)$val;
        }

        // Узнаем какие подкатегории нужны
        $departmentsId = DB::table('departments')->select("departments_id")->where('departments_alias', '=', $departments)->get();
        $newDepart = null;

        foreach ($departmentsId as $val) {
            $newDepart = (array)$val;
        }

        $dataByDepart = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newGen['sex_id'])
            ->where('categories_id', '=', $newCateg['categories_id'])
            ->where('departments_id', '=', $newDepart['departments_id'])
            ->whereBetween('product_price', [$min, $max])
            ->orderBy('product_id', 'desc')
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
            ->where('categories_id', '=', $newCateg['categories_id'])
            ->where('departments_id', '=', $newDepart['departments_id'])
            ->max('product_price');

        $dataSizes = DB::table('catalog_size')
            ->join('products', 'catalog_size.product_id', '=', 'products.product_id')->select('sizes_number', 'products.product_id')
            ->join('sizes', 'catalog_size.sizes_id', '=', 'sizes.sizes_id')
            ->where('sex_id', '=', $newGen['sex_id'])
            ->where('categories_id', '=', $newCateg['categories_id'])
            ->where('departments_id', '=', $newDepart['departments_id'])
            ->whereBetween('product_price', [$min, $max])
            ->get();

        $dataByDepart['max'] = $productMax;
        $dataByDepart['min'] = $productMin;
        $dataByDepart['sizes'] = $dataSizes;

        return $dataByDepart;
    }
}
