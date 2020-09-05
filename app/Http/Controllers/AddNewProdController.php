<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use DB;

class AddNewProdController extends Controller
{
    public function add(Request $request) {

        $id = $request->only('id');
        $product_id = $id['id'];

        DB::table('products')->insert([
            'product_img' => public_path()."/img/item-$product_id",
            'product_video' => public_path()."/img/item-$product_id"
        ]);

        Storage::makeDirectory(public_path() ."/img/item-$product_id");
        return true;
    }

    public function update(Request $request) {
        $product = $request->all();
        $productStr = json_decode($product['stringData'], true);

        // Изменеяем название
        if (isset($productStr['name'])) {
            DB::table('products')
                ->where('product_id', $productStr['id'])
                ->update(['product_title' => $productStr['name']]);
        }

        // Изменяем категории
        if (isset($productStr['category'])) {
            DB::table('products')
                ->where('product_id', $productStr['id'])
                ->update(['sex_id' => $productStr['category']['sexId']]);

            DB::table('products')
                ->where('product_id', $productStr['id'])
                ->update(['categories_id' => $productStr['category']['categId']]);

            DB::table('products')
                ->where('product_id', $productStr['id'])
                ->update(['departments_id' => $productStr['category']['departId']]);
        }

        // Измененяем артикул
        if (isset($productStr['vendor'])) {
            DB::table('products')
                ->where('product_id', $productStr['id'])
                ->update(['product_vendor' => (int)$productStr['vendor']]);
        }

        // Изменяем описание
        if (isset($productStr['description'])) {
            DB::table('products')
                ->where('product_id', $productStr['id'])
                ->update(['product_description' => $productStr['description']]);
        }

        if (isset($productStr['price'])) {
            DB::table('products')
                ->where('product_id', $productStr['id'])
                ->update(['product_price' => (int)$productStr['price']]);
        }

        if (isset($productStr['sale'])) {
            DB::table('products')
                ->where('product_id', $productStr['id'])
                ->update(['product_sale' => 1]);

            DB::table('products')
                ->where('product_id', $productStr['id'])
                ->update(['product_price' => $productStr['sale']['newPrice']]);

            DB::table('products')
                ->where('product_id', $productStr['id'])
                ->update(['product_old_price' => $productStr['sale']['oldPrice']]);
        }

        if (isset($productStr['sizeFresh'])) {
            DB::table('catalog_size')->insert([
                [
                    'product_id' => $productStr['id'],
                    'sizes_id' => $productStr['sizeFresh']['sizeId'],
                    'catalog_size_amount' => $productStr['sizeFresh']['count']
                ]
            ]);
        }
        if (isset($productStr['sizeOld'])) {
            DB::table('catalog_size')
                ->where('product_id', $productStr['id'])
                ->where('sizes_id', $productStr['sizeOld']['sizeId'])
                ->update(['catalog_size_amount' => $productStr['sizeOld']['count']]);
        }
        return true;
//        $imgPath = "";
//
//        for ($prd = 0; $prd < count($product); $prd++) {
//
//            if ($request->hasFile("img-$prd")) {
//                $img = $request->file("img-$prd");
//                $img->move(public_path() . "/img/item-$product_id", "img_$prd-item-$product_id" . ".png");
//                $imgPath .= "/img/item-$product_id/" . "img_$prd-item-$product_id" . ".png" . ", ";
//            }
//        }
//
//        $videoPath = "";
//
//        if ($request->hasFile('video')) {
//            $video = $request->file('video');
//            $video->move(public_path() . "/img/item-$product_id", "video-item-$product_id" . ".mp4");
//            $videoPath = "/img/item-$product_id/" . "video-item-$product_id" . ".mp4";
//        }
//
//        if (isset($productStr['name'])) {
//            DB::table('products')
//                ->where('product_id', $id)
//                ->update(['product_title' => $productStr['name']]);
//        }
//
//        if (isset($productStr['price'])) {
//            DB::table('products')
//                ->where('product_id', $id)
//                ->update(['product_price' => (int)$productStr['price']]);
//        }
//
////        DB::table('products')
////            ->where('product_id', $id)
////            ->update(['product_sale' => 0]);
//
//        if (isset($productStr['description'])) {
//            DB::table('products')
//                ->where('product_id', $id)
//                ->update(['product_description' => $productStr['description']]);
//        }
//
//        if (isset($productStr['vendor'])) {
//            DB::table('products')
//                ->where('product_id', $id)
//                ->update(['product_vendor' => (int)$productStr['vendor']]);
//        }
//
//        if (isset($productStr['category']['sexId'])) {
//            DB::table('products')
//                ->where('product_id', $id)
//                ->update(['sex_id' => $productStr['category']['sexId']]);
//        }
//
//        if (isset($productStr['category']['categId'])) {
//            DB::table('products')
//                ->where('product_id', $id)
//                ->update(['categories_id' => $productStr['category']['categId']]);
//        }
//
//        if (isset($productStr['category']['departId'])) {
//            DB::table('products')
//                ->where('product_id', $id)
//                ->update(['departments_id' => $productStr['category']['departId']]);
//        }

//        if ($productStr['sizes'] !== NULL){
//            echo 'sizes';
//            foreach ($productStr['sizes'] as $size) {
//
//                DB::table('catalog_size')->insert([
//                    [
//                        'product_id' => $product_id,
//                        'sizes_id' => $size['id'],
//                        'catalog_size_amount' => $size['count']
//                    ]
//                ]);
//
//            }
//        }else{
//            DB::table('catalog_size')->insert([
//                [
//                    'product_id' => $product_id,
//                    'sizes_id' => NULL,
//                    'catalog_size_amount' => (int)$productStr['amountWithoutSizes']
//                ]
//            ]);
//        }

    }
}
