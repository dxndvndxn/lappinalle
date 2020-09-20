<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainPageController extends Controller
{
    public function index(Request $request)
    {
        try {
            $maindb = DB::table('mainpage')->where('mainpage_id', 1)->get();
            $main = null;

            foreach ($maindb as $val) {
                $main = (array)$val;
            }

            $main_img = $main['mainpage_main_img'];
            $main_h1 = $main['mainpage_main_h1'];
            $main_h2 = $main['mainpage_main_h2'];
            $main_h3 = $main['mainpage_main_h3'];
            $main_but_text = $main['mainpage_main_but_text'];
            $main_but_href = $main['mainpage_main_but_href'];

            $main = [$main_img, $main_h1, $main_h2, $main_h2, $main_h3, $main_but_text, $main_but_href];

            $block_count = DB::table('mainpage')->count();
            $id = 2;
            $i = 0;

            $blocks = [NULL];

            while ($block_count > 1) {

                $data = DB::table('mainpage')->where('mainpage_id', $id)->get();
                $block_data = null;
                foreach ($data as $val) {
                    $block_data = (array)$val;
                }

                $blocks[$i] = [
                    'block_id' => $block_data['mainpage_id'],
                    'block_name' => $block_data['mainpage_name'],
                    'block_sex' => $block_data['mainpage_block_sex'],
                    'block_cat' => $block_data['mainpage_block_cat'],
                    'block_dep' => $block_data['mainpage_block_dep'],
                    'block_h1' => $block_data['mainpage_block_h1'],
                    'block_sale' => $block_data['mainpage_block_sale'],
                    'block_price' => $block_data['mainpage_block_price'],
                    'block_but_text' => $block_data['mainpage_block_but_text'],
                    'block_but_href' => $block_data['mainpage_block_but_href']
                ];

                $block_count--;
                $i++;
                $id++;
            }

            $blocks_karuseli = [];
            $j = 0;

            $products = DB::table('products')->where([
                ['sex_id', $block_data['mainpage_block_sex']],
                ['categories_id', $block_data['mainpage_block_cat']],
                ['departments_id', $block_data['mainpage_block_dep']]
            ])->get();
            $productsWrap = [];

            foreach ($products as $val){
                array_push($productsWrap, (array)$val);
            }

            $karuseli_count = count($products);

            while ($karuseli_count > 0) {

                $blocks_karuseli[$karuseli_count] = [
                    $productsWrap[$j]['product_id'],
                    $productsWrap[$j]['product_img'],
                    $productsWrap[$j]['product_title'],
                    $productsWrap[$j]['product_price'],
                    $productsWrap[$j]['product_sale']
                ];
                $j++;
                $karuseli_count--;
            }

            $allblockinfo = [$main, $blocks, $blocks_karuseli];

            return $allblockinfo;
        }catch (\Exception $e){
            return $e;
        }
    }

    public function update(Request $request) {
        $request_data = $request->all();
        $stringData = json_decode($request_data['data'], true);

        if (isset($stringData['addEmptyBlock'])) {
            DB::table('mainpage')->insert([
                [
                    'mainpage_name' => NULL
                ]
            ]);
            return 'HUI';
        }

        $id = $stringData["id"];

        if ($id === 1) {
            if ($request->hasFile("mainpage_main_img")) {
                Storage::makeDirectory(public_path() ."/img/baner-$id");
                unlink(public_path("/img/baner-$id/" . "img_baner-$id" . ".png"));

                $img = $request->file("mainpage_main_img");
                $img->move(public_path() . "/img/baner-$id", "img_baner-$id" . ".png");
                $imgPath = "/img/baner-$id/" . "img_baner-$id" . ".png";
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_main_img' => $imgPath]);
                return true;
            }
            if (isset($stringData['mainpage_main_h1'])){
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_main_h1' => $stringData['mainpage_main_h1']]);
                return true;
            }

            if (isset($stringData['mainpage_main_h2'])){
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_main_h2' => $stringData['mainpage_main_h2']]);
                return true;
            }

            if (isset($stringData['mainpage_main_h3'])){
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_main_h3' => $stringData['mainpage_main_h3']]);
                return true;
            }

            if (isset($stringData['mainpage_main_but_text'])){
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_main_but_text' => $stringData['mainpage_main_but_text']]);
                return true;
            }

            if (isset($stringData['mainpage_main_but_href'])){
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_main_but_href' => $stringData['mainpage_main_but_href']]);
                return true;
            }
        }else{
            if (isset($request_data['mainpage_name'])) {
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_name' => $request_data['mainpage_name']]);
            }
            if (isset($stringData['mainpage_block_menu_sex'])){
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_block_menu_sex' => $stringData['mainpage_block_menu_sex']]);
                return true;
            }
            if (isset($stringData['mainpage_block_menu_cat'])){
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_block_menu_cat' => $stringData['mainpage_block_menu_cat']]);
                return true;
            }
            if (isset($stringData['mainpage_block_menu_dep'])){
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_block_menu_dep' => $stringData['mainpage_block_menu_dep']]);
                return true;
            }
            if (isset($request_data['mainpage_block_menu_h1'])) {
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_block_menu_h1' => $request_data['mainpage_block_menu_h1']]);
            }
            if (isset($request_data['mainpage_block_menu_sale'])){
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_block_menu_sale' => $request_data['mainpage_block_menu_sale']]);
            }
            if (isset($request_data['mainpage_block_menu_price'])){
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_block_menu_price' => $request_data['mainpage_block_menu_price']]);
            }
            if (isset($request_data['mainpage_block_but_text'])) {
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_block_but_text' => $request_data['mainpage_block_but_text']]);
            }
            if (isset($request_data['mainpage_block_but_href'])) {
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_block_but_href' => $request_data['mainpage_block_but_href']]);
            }
        }
    }
}
