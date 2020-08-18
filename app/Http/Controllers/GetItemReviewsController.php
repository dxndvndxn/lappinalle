<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GetItemReviewsController extends Controller
{
    public function index(Request $request, $itemNumber){
        $dataReview = DB::table('reviews')
            ->crossJoin('users', 'reviews.users_id', '=', 'users.users_id')
            ->select('users_name', 'reviews_text', 'reviews_created', 'reviews_star')
            ->where('reviews_available', '=', 1)
            ->where('reviews.product_id', '=', $itemNumber)
            ->orderBy('reviews.reviews_id', 'desc')
            ->paginate(3);

        return $dataReview;
    }
}
