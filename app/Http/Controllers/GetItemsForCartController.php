<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GetItemsForCartController extends Controller
{
    public function index(Request $request, $ids){
        // Преобразовываем строку в массив
        $productsId = explode(', ',  $ids);
        $products = DB::table('products')->select("product_id", "product_title", "product_price", "product_description", "product_img")
            ->where('product_available', '=', 1)
            ->whereIn('product_id',  $productsId)
            ->get();
        $products['eu'] = GetEUController::EU('http://www.cbr.ru/scripts/XML_daily.asp');
        return $products;
    }
}
