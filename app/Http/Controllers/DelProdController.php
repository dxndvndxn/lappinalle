<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DelProdController extends Controller
{
    public function del(Request $request) {

        $id = $request->only('id');
        $id = $id['id'];

        DB::table('products')->where(['product_id' => $id])->delete();

        $directory = public_path() ."/img/item-$id";
        Storage::deleteDirectory($directory);

    }
}
