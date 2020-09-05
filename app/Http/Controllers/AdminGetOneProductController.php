<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminGetOneProductController extends Controller
{
    public function index(Request $request, $id){
        $oneProduct = DB::table('products')->where('product_id', '=', $id)->get();
        $sizesData = DB::table('catalog_size')
            ->join('sizes', 'catalog_size.sizes_id', '=', 'sizes.sizes_id')
            ->select('sizes_number', 'sizes.sizes_id', 'catalog_size_amount')
            ->get();
        $oneProduct['allSizes'] = $sizesData;
        return $oneProduct;
    }
}
