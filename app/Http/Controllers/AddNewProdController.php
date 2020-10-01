<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use DB;
use Exception;
class AddNewProdController extends Controller
{
    public function add(Request $request) {

        $id = $request->only('id');
        $product_id = $id['id'];

        DB::table('products')->insert([
            ['added_on' => Carbon::now()->format('Y-m-d H:i:s')]
        ]);

        Storage::makeDirectory(public_path() ."/img/item-$product_id");
        return true;
    }

    public function getExtension($filename) {
        $img = explode(".", $filename);
        return end($img);
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

        $product_id = $productStr['id'];

        if (isset($productStr['img'])){

            $imgPath = "";

            $imgString = DB::table('products')
                ->where('product_id', $productStr['id'])
                ->select('product_img')
                ->value('product_img');

            // Если в БД есть уже фотки, то
            // $imgArr - разделяем строку на массив по запятой
            // $countFrom - длина для определения названия следующей фотографии (минус 1 так в массиве в конце добавляется пустая строка)
            // $imgPath - присваиваем уже существующую строку из БД
            // Дальше в цикле добавляем $countFrom в название новой фотографии
            if ($imgString !== NULL){

                $imgArr = explode(', ', $imgString);
                $countFrom = count($imgArr);
                $imgPath .= $imgString;

                for ($prd = 0; $prd < count($product); $prd++) {

                    if ($request->hasFile("img-$prd")) {
                        $img = $request->file("img-$prd");
                        $nameFile = $request->file("img-$prd")->getClientOriginalName();
                        $ext = pathinfo($nameFile, PATHINFO_EXTENSION);

                        if ($ext === 'jpg') {
                            $img->move(public_path() . "/img/item-$product_id", "img_$countFrom-item-$product_id" . ".jpg");
                            $imgPath .= "/img/item-$product_id/" . "img_$countFrom-item-$product_id" . ".jpg" . ", ";
                            $countFrom += $countFrom;
                        }
                        if ($ext === 'png') {
                            $img->move(public_path() . "/img/item-$product_id", "img_$countFrom-item-$product_id" . ".png");
                            $imgPath .= "/img/item-$product_id/" . "img_$countFrom-item-$product_id" . ".png" . ", ";
                            $countFrom += $countFrom;
                        }
                    }
                }

                DB::table('products')
                    ->where('product_id', $productStr['id'])
                    ->update(['product_img' => $imgPath]);
            }
            // Если в БД вернула пустую строку, то просто добавляем фотографии как обычно
            else{
                for ($prd = 0; $prd < count($product); $prd++) {

                    if ($request->hasFile("img-$prd")) {
                        $img = $request->file("img-$prd");
                        $nameFile = $request->file("img-$prd")->getClientOriginalName();
                        $ext = pathinfo($nameFile, PATHINFO_EXTENSION);

                        if ($ext == 'jpg') {
                            $img->move(public_path() . "/img/item-$product_id", "img_$prd-item-$product_id" . ".jpg");
                            $imgPath .= "/img/item-$product_id/" . "img_$prd-item-$product_id" . ".jpg" . ", ";
                        }
                        if ($ext == 'png') {
                            $img->move(public_path() . "/img/item-$product_id", "img_$prd-item-$product_id" . ".png");
                            $imgPath .= "/img/item-$product_id/" . "img_$prd-item-$product_id" . ".png" . ", ";
                        }
                    }
                }

                DB::table('products')
                    ->where('product_id', $productStr['id'])
                    ->update(['product_img' => $imgPath]);
            }
        }
        $videoPath = "";
        if (isset($product['video'])) {

            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $video->move(public_path() . "/img/item-$product_id", "video-item-$product_id" . ".mp4");
                $videoPath = "/img/item-$product_id/" . "video-item-$product_id" . ".mp4";
            }
            DB::table('products')
                ->where('product_id', $productStr['id'])
                ->update(['product_video' => $videoPath]);
        }

        if (isset($productStr['vidRemove'])) {
            unlink(public_path($productStr['vidRemove']));
            DB::table('products')
                ->where('product_id', $productStr['id'])
                ->update(['product_video' => NULL]);

        }

        if (isset($productStr['deletedImg'])){
            unlink(public_path($productStr['deletedImg']));
            DB::table('products')
                ->where('product_id', $productStr['id'])
                ->update(['product_img' => $productStr['updatedImg']]);
        }

        if (isset($productStr['relatedId'])) {
            DB::table('products')
                ->where('product_id', $productStr['id'])
                ->update(['product_related' => $productStr['relatedId']]);
        }

        if (isset($productStr['sizeWithoutSale'])) {
            DB::table('products')
                ->where('product_id', $productStr['id'])
                ->update(['product_sizes_without_sale' => $productStr['sizeWithoutSale']]);
        }
        return true;
    }
}
