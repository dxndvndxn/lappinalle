<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminDeleteSizeController extends Controller
{
    public function remove(Request $request){
        $id = $request->only('id');
        DB::table('catalog_size')->where('catalog_size_id' , '=', $id)->delete();
        return true;
    }
}
