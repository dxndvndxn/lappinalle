<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GetItemByGenderController extends Controller
{
    public function index(Request $request, $number){
        $getItemData = DB::table('products')->select('product_id','product_title','product_price','product_description','product_img','product_video','product_sale')->where('product_id', '=', $number)->get();
        $dataNreview = [];
        $dataItemByGender = DB::table('reviews')
            ->crossJoin('users', 'reviews.users_id', '=', 'users.users_id')
            ->select('users_name', 'reviews_text', 'reviews_created', 'reviews_star')
            ->orderBy('reviews.reviews_id', 'desc')
            ->where('reviews_available', '=', 1)
            ->where('reviews.product_id', '=', $number)->orderBy('reviews_id')
            ->limit(3)->get();
        foreach ($getItemData as $val){
            array_push($dataNreview, (array) $val);
        }
        foreach ($dataItemByGender as $val){
            array_push($dataNreview, (array) $val);
        }
        return $dataNreview;
    }
}
