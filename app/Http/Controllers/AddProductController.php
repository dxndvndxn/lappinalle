<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use DB;

class AddProductController extends Controller
{
    public function index(Request $request){

        $product = $request->all();
        $productStr = json_decode($product['stringData'], true);
        $product_id = $productStr['id'];

        Storage::makeDirectory(public_path() ."/img/item-$product_id");
        $imgPath = "";

        for ($prd = 0; $prd < count($product); $prd++) {

            if ($request->hasFile("img-$prd")) {
                $img = $request->file("img-$prd");
                $img->move(public_path() . "/img/item-$product_id", "img_$prd-item-$product_id" . ".png");
                $imgPath .= "/img/item-$product_id/" . "img_$prd-item-$product_id" . ".png" . ", ";
            }
        }

        $videoPath = "";

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $video->move(public_path() . "/img/item-$product_id", "video-item-$product_id" . ".mp4");
            $videoPath = "/img/item-$product_id/" . "video-item-$product_id" . ".mp4";
        }
        echo $productStr['sale'];
        if ($productStr['sale'] !== NULL) {

            $product = DB::table('products')->insert([
                [
                    'product_title' => $productStr['name'],
                    'product_price' => $productStr['sale'],
                    'product_sale' => 1,
                    'product_old_price' => (int)$productStr['price'],
                    'product_description' => $productStr['description'],
                    'product_img' => $imgPath,
                    'product_video' => $videoPath,
                    'product_available' => 1,
                    'product_vendor' => (int)$productStr['vendor'],
                    'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                    'sex_id' => $productStr['category']['sexId'],
                    'categories_id' => $productStr['category']['categId'],
                    'departments_id' => $productStr['category']['departId']
                ]
            ]);

        }
        else {
            $product = DB::table('products')->insert([
                [
                    'product_title' => $productStr['name'],
                    'product_price' => (int)$productStr['price'],
                    'product_old_price' => null,
                    'product_sale' => 0,
                    'product_description' => $productStr['description'],
                    'product_img' => $imgPath,
                    'product_video' => $videoPath,
                    'product_available' => 1,
                    'product_vendor' => (int)$productStr['vendor'],
                    'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                    'sex_id' => $productStr['category']['sexId'],
                    'categories_id' => $productStr['category']['categId'],
                    'departments_id' => $productStr['category']['departId']
                ]
            ]);
        }

        if  ($productStr['sizes'] !== NULL){
            echo 'sizes';
            foreach ($productStr['sizes'] as $size) {

                DB::table('catalog_size')->insert([
                    [
                        'product_id' => $product_id,
                        'sizes_id' => $size['id'],
                        'catalog_size_amount' => $size['count']
                    ]
                ]);

            }
        }else{
            DB::table('catalog_size')->insert([
                [
                    'product_id' => $product_id,
                    'sizes_id' =>  NULL,
                    'catalog_size_amount' => (int)$productStr['amountWithoutSizes']
                ]
            ]);
        }
//        if ($productStr['amountWithoutSizes'] !== NULL) {
//            DB::table('catalog_size')->insert([
//                [
//                    'product_id' => $product_id,
//                    'sizes_id' =>  NULL,
//                    'catalog_size_amount' => (int)$productStr['amountWithoutSizes']
//                ]
//            ]);
//        }

        return true;
    }
}
