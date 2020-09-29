<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BookmarkProductsController extends Controller
{
    public function index(Request $request, $ids) {
        $products = explode(',', $ids);

        $query = DB::table('products')
            ->select("product_id","product_title", "product_price", "product_img", "product_old_price", 'sex.sex_alias')
            ->leftJoin('sex', 'products.sex_id', '=', 'sex.sex_id')
            ->whereIn("product_id", $products)
            ->get();

        $data = null;

        $data['products'] = $query;
        $data['eu'] = (int)GetEUController::EU();

        return $data;
    }
}
