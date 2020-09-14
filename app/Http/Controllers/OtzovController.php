<?php

namespace App\Http\Controllers;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;

class OtzovController extends Controller
{
    public function moder(Request $request) {

        $otzid = $request->only('reviews_id');
        $otzid = $otzid['reviews_id'];
        $otzmod = $request->only('reviews_available');
        $otzmod = $otzmod['reviews_available'];

        DB::table('reviews')->where(['reviews_id' => $otzid])->update(['reviews_available' => $otzmod]);
        return true;
    }

    public function newreview(Request $request) {
        $text = $request->only('review_text');
        $text = $text['review_text'];
        $star = $request->only('review_star');
        $star = $star['review_star'];
        $token = $request->only('token');
        $token = $token['token'];
        $user = DB::table('lappiusers')->select('lappiusers_id')->where('lappiusers_token', '=', $token)->value('lappiusers_id');
        $product = $request->only('product_id');
        $product = $product['product_id'];
        $date = Carbon::now();
        DB::table('reviews')->insert([
            [
                'reviews_text' => $text,
                'reviews_created' => $date,
                'reviews_star' => $star,
                'reviews_available' => 0,
                'product_id' => $product,
                'lappiusers_id' => $user
            ]
        ]);
        return true;
    }


    public function revcard(Request $request, $id) {
        $review = DB::table('reviews')
            ->where('reviews_id', '=', $id)
            ->join('lappiusers', 'reviews.lappiusers_id', 'lappiusers.lappiusers_id')
            ->join('products', 'reviews.product_id', 'products.product_id')
            ->select('products.product_title', 'reviews_created', 'lappiusers.lappiusers_id', 'lappiusers.lappiusers_name', 'reviews_id', 'reviews_star', 'reviews_text')
            ->get();

        return $review;
    }


    public function allrev(Request $request) {

        $reviews = DB::table('reviews')
            ->join('lappiusers', 'reviews.lappiusers_id', 'lappiusers.lappiusers_id')
            ->join('products', 'reviews.product_id', 'products.product_id')
            ->select('lappiusers.lappiusers_name', 'products.product_title', 'reviews_id', 'reviews_created')
            ->orderBy('reviews_id', 'desc')
            ->get();

        return $reviews;
    }
}
