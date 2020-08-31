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
            ->select('products.product_price', 'catalog_size_amount', 'products.product_id', 'products.product_title', 'products.product_vendor','products.sex_id','products.sex_id', 'products.categories_id', 'products.departments_id')
            ->orderBy('products.product_id', 'desc')
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
            $nextI = $i++;
            if ($nextI + 1 == count($totalProduct)) break;

            if ($totalProduct[$nextI]['product_id'] === $totalProduct[$i]['product_id']) {
                $totalProduct[$i]['catalog_size_amount'] = $totalProduct[$i]['catalog_size_amount'] + $totalProduct[$nextI]['catalog_size_amount'];
                unset($totalProduct[$nextI]);
            }
        }
        return $totalProduct;
    }
}