<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class AddProductController extends Controller
{
    public function index(Request $request){

        $product = $request->all();
        $productStr = json_decode($product['stringData'], true);

//        $product_name = $product_str['name'];
        $product_id = $productStr['id'];
//        $product_desc = $product_str['description'];
//        $product_vendor = $product_str['vendor'];
//        $product_price = $product_str['price'];
//        $product_sale = $product_str['sale'];
//        $product_sexid = $product_str['sexId'];
//        $product_categid = $product_str['categId'];
//        $product_departid = $product_str['departId'];
        Storage::makeDirectory(public_path() ."/item-$product_id");

        for ($prd = 0; $prd < count($product); $prd++) {

            if ($request->hasFile("img-$prd")) {
                $img = $request->file("img-$prd");
                $img->move(public_path() . "/item-$product_id", "img_$prd-item-$product_id" . ".png");
            }
        }

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $video->move(public_path() . "/item-$product_id", "video-item-$product_id" . ".mp4");
        }

        return $product;
    }
}
