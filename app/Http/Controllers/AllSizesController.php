<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AllSizesController extends Controller
{
    public function index(Request $request){
        $sizes = DB::table('sizes')->get();
        return $sizes;
    }
}
