<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SaleProductsByCategoriesController extends Controller
{
    public function index(Request $request, $gender, $categories){

        // Узнаем какой гендер нужен
        $sexId = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $gender)->get();
        $newGen = null;

        foreach ($sexId as $val){
            $newGen = (array) $val;
        }

        // Узнаем какая категория нужна
        $categoryId = DB::table('categories')->select("categories_id")->where('categories_alias', '=', $categories)->get();
        $newCateg = null;

        foreach ($categoryId as $val){
            $newCateg = (array) $val;
        }

        $dataByCateg = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
            ->where('product_available', '=', 1)
            ->where('sex_id', '=', $newGen['sex_id'])
            ->where('categories_id', '=', $newCateg['categories_id'])
            ->where('product_sale', '=', 1)
            ->orderBy('product_id', 'desc')
            ->paginate(30);

        // Получаем мин стоимость
        $productMin =  DB::table('products')
            ->where('product_available', '=', 1)
            ->where('product_sale', '=', 1)
            ->where('sex_id', '=', $newGen['sex_id'])
            ->where('categories_id', '=', $newCateg['categories_id'])
            ->min('product_price');

        // Получаем макс стоимость
        $productMax =  DB::table('products')
            ->where('product_available', '=', 1)
            ->where('product_sale', '=', 1)
            ->where('sex_id', '=', $newGen['sex_id'])
            ->where('categories_id', '=', $newCateg['categories_id'])
            ->max('product_price');

        $dataSizes = DB::table('catalog_size')
            ->join('products', 'catalog_size.product_id', '=', 'products.product_id')->select('sizes_number', 'products.product_id')
            ->join('sizes', 'catalog_size.sizes_id', '=', 'sizes.sizes_id')
            ->where('sex_id', '=', $newGen['sex_id'])
            ->where('categories_id', '=', $newCateg['categories_id'])
            ->where('product_sale', '=', 1)
            ->get();

        $dataByCateg['eu'] = (int)GetEUController::EU();
        $dataByCateg['max'] = $productMax * (int)GetEUController::EU();
        $dataByCateg['min'] = $productMin * (int)GetEUController::EU();
        $dataByCateg['sizes'] = $dataSizes;

        return $dataByCateg;
    }
}
