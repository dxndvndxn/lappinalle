<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AllSizeForSideBarController extends Controller
{
    public function index(Request $request) {
        $dataSizes = DB::table('catalog_size')
            ->join('products', 'catalog_size.product_id', '=', 'products.product_id')->select('sizes_number', 'products.product_id')
            ->join('sizes', 'catalog_size.sizes_id', '=', 'sizes.sizes_id')
            ->get();
        return $dataSizes;
    }
}
