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
    public function newsize(Request $request) {

        $newsize = $request->only('newsize');
        DB::table('sizes')->insert(['sizes_number' => $newsize['newsize']]);
        return true;
    }
    public function DeleteNewSize(Request $request){
        $deletedSize = $request->only('sizeId');
        DB::table('sizes')->where('sizes_id', $deletedSize['sizeId'])->delete();
        return true;
    }
}
