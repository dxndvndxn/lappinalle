<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GetDataItemController extends Controller
{
    public function index(Request $request, $number){
        // Забираем данные для товара
        $getItemData = DB::table('products')->select('product_id','product_title','product_price','product_description','product_img','product_video','product_sale')->where('product_id', '=', $number)->get();
        $dataNreview = [];

        $reviewStar = DB::table('reviews')->select('reviews_star')->where('reviews.product_id', '=', $number)->get();

        // Забираем послдние 3 отзыва
        $dataItem = DB::table('reviews')
            ->crossJoin('users', 'reviews.users_id', '=', 'users.users_id')
            ->select('users_name', 'reviews_text', 'reviews_created', 'reviews_star')
            ->orderBy('reviews.reviews_id', 'desc')
            ->where('reviews_available', '=', 1)
            ->where('reviews.product_id', '=', $number)->orderBy('reviews_id')
            ->limit(3)->get();

        // Приводи к обрабатываемому виду данные о товаре
        foreach ($getItemData as $val){
            array_push($dataNreview, (array) $val);
        }

        // Приводи к обрабатываемому виду данные об отзывах
        foreach ($dataItem as $val){
            array_push($dataNreview, (array) $val);
        }

        // Приводи к обрабатываемому виду данные об отзывах
        $stars = [];
        foreach ($reviewStar as $val){
            array_push($stars, (array) $val);
        }

        $dataNreview['stars'] = $stars;
        return $dataNreview;
    }
}
