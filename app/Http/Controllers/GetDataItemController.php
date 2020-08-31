<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GetDataItemController extends Controller
{
    public function index(Request $request, $number){
        // Забираем данные для товара
        $getItemData = DB::table('products')->select('product_id','product_title','product_price','product_description','product_img','product_video','product_old_price')
            ->where('product_id', '=', $number)->get();

        $reviewStar = DB::table('reviews')->select('reviews_star')->where('reviews.product_id', '=', $number)->get();

        // Получаем размеры к данному товару
        $sizesData = DB::table('catalog_size')->where('product_id', '=', $number)
            ->join('sizes', 'catalog_size.sizes_id', '=', 'sizes.sizes_id')
            ->select('sizes_number')
            ->get();

        $dataNreview = [];

        // Приводи к обрабатываемому виду данные о товаре
        foreach ($getItemData as $val){
            array_push($dataNreview, (array) $val);
        }

        // Приводи к обрабатываемому виду данные об отзывах
        $stars = [];
        foreach ($reviewStar as $val){
            array_push($stars, (array) $val);
        }

        $sizes = [];
        // Приводи к обрабатываемому виду данные об размерах
        foreach ($sizesData as $val){
            array_push($sizes, (array) $val);
        }

        $dataNreview['stars'] = $stars;
        $dataNreview['sizes'] = $sizes;
        return $dataNreview;
    }
}
