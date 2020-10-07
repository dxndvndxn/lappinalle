<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GetItemsForCartController extends Controller
{
    public function index(Request $request, $ids){
        // Преобразовываем строку в массив
        $productsId = explode(', ',  $ids);
        $products = DB::table('products')->select("product_id", "product_title", "product_price", "product_description", "product_img", 'product_sizes_without_sale', 'product_old_price')
            ->where('product_available', '=', 1)
            ->whereIn('product_id',  $productsId)
            ->get();
        $wrapArr = [];
        foreach ($products as $value){
            array_push($wrapArr, (array) $value);
        }

        foreach ($wrapArr as $i => $value){
            $wrapArr[$i]['product_price'] = $wrapArr[$i]['product_price'] * (int)GetEUController::EU();
            $wrapArr[$i]['product_old_price'] = $wrapArr[$i]['product_old_price'] !== null ? $wrapArr[$i]['product_old_price'] * (int)GetEUController::EU() : $wrapArr[$i]['product_old_price'];
        }

        $products = $wrapArr;
        return $products;
    }
}
