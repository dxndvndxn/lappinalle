<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminGetOneProductController extends Controller
{
    public function index(Request $request, $id){
        $oneProduct = DB::table('products')->where('product_id', '=', $id)->get();
        $sizesData = DB::table('catalog_size')->where('product_id', '=', $id)
            ->join('sizes', 'catalog_size.sizes_id', '=', 'sizes.sizes_id')
            ->select('sizes_number', 'sizes.sizes_id', 'catalog_size_amount', 'catalog_size_id')
            ->get();
        if (!count($sizesData)) {
            $sizesData = DB::table('catalog_size')->where('product_id', '=', $id)
                ->get();
        }
        $oneProduct['allSizes'] = $sizesData;
        $oneProduct['allIds'] = DB::table('products')->select('product_id')->get();
        return $oneProduct;
    }
}
