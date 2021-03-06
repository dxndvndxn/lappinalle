<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminGetAllProductsController extends Controller
{
    public function index(Request $request)
    {
        $allProducts = DB::table('catalog_size')
            ->rightJoin('products', 'catalog_size.product_id', '=', 'products.product_id')
            ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
            ->leftJoin('categories', 'products.categories_id', '=', 'categories.categories_id')
            ->leftJoin('departments', 'products.departments_id', '=', 'departments.departments_id')
            ->select('departments.departments_alias', 'categories.categories_alias', 'sex.sex_alias', 'products.product_price', 'catalog_size_amount', 'products.product_id', 'products.product_title', 'products.product_vendor','products.sex_id', 'products.categories_id', 'products.departments_id', 'products.product_position')
            ->orderBy('products.product_position', 'desc')
            ->get();

        $totalProduct = [];
        // Приводим данные к обрабатываемому виду
        foreach ($allProducts as $product) {
            array_push($totalProduct, (array) $product);
        }

        // Фильтруем данные на повторяющиеся id
        // Если id повторяются, то увеличиваем кол-во данного товара и удаляем потвторяющийся элемент

        foreach ($totalProduct as $i => $product){
            $totalProduct[$i]['active'] = false;
            $totalProduct[$i]['name'] = null;
            $nextI = $i + 1;

//            if ($nextI > count($totalProduct)) {
//                break;
//            }
            if (!isset($totalProduct[$nextI]['product_id'])){
                break;
            }

            if ($totalProduct[$i]['product_id'] === $totalProduct[$nextI]['product_id']) {
                $totalProduct[$nextI]['catalog_size_amount'] = $totalProduct[$i]['catalog_size_amount'] + $totalProduct[$nextI]['catalog_size_amount'];
                unset($totalProduct[$i]);
            }
        }
        return $totalProduct;
    }
}
