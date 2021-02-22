<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {

        $s = $request->only('search');
        $s = $s['search'];

        $data = DB::table('products')->where('product_title', 'LIKE', "%".$s."%")->select("product_id","product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')->get();
        
        return [$data, (int)GetEUController::EU()];

    }
    public function SearchAdmin(Request $request) {
        $s = $request->all();
        $s = $s['search'];

        $allProducts = DB::table('catalog_size')
            ->rightJoin('products', 'catalog_size.product_id', '=', 'products.product_id')
            ->where('products.product_title', 'LIKE', "%".$s."%")
            ->select('products.product_price', 'catalog_size_amount', 'products.product_id', 'products.product_title', 'products.product_vendor','products.sex_id', 'products.categories_id', 'products.departments_id')
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
            $totalProduct[$i]['name'] = null;
            $nextI = $i + 1;


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
