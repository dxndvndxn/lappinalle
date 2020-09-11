<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;

class GetItemReviewsController extends Controller
{
    public function index(Request $request, $itemNumber){
        $dataReview = DB::table('reviews')
            ->crossJoin('lappiusers', 'reviews.lappiusers_id', '=', 'lappiusers.lappiusers_id')
            ->select('users_name', 'reviews_text', 'reviews_created', 'reviews_star')
            ->where('reviews_available', '=', 1)
            ->where('reviews.product_id', '=', $itemNumber)
            ->orderBy('reviews.reviews_id', 'desc')
            ->paginate(3);

        return $dataReview;
    }
}
