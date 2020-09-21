<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

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

            $main = [$main_img, $main_h1, $main_h2, $main_h3, $main_but_text, $main_but_href];

            $block_count = DB::table('mainpage')->count();
            $id = DB::table('mainpage')->select('mainpage_id')->skip(1)->take(2)->value('mainpage_id');
            $i = 0;

            $blocks = [NULL];

            if ($block_count !== 1) {
                while ($block_count > 1) {

                    $data = DB::table('mainpage')->where('mainpage_id', $id)->get();

                    $block_data = null;

                    foreach ($data as $val) {
                        $block_data = (array)$val;
                    }

                    $blocks[$i] = [
                        'block_id' => $block_data['mainpage_id'],
                        'block_carousel_h1' => $block_data['mainpage_name'],
                        'block_sex' => $block_data['mainpage_block_sex'],
                        'block_cat' => $block_data['mainpage_block_cat'],
                        'block_dep' => $block_data['mainpage_block_dep'],
                        'block_h1' => $block_data['mainpage_block_h1'],
                        'block_sale' => $block_data['mainpage_block_sale'],
                        'block_price' => $block_data['mainpage_block_price'],
                        'block_but_text' => $block_data['mainpage_block_but_text'],
                        'block_but_href' => $block_data['mainpage_block_but_href'],
                        'block_img' => $block_data['mainpage_main_img'],
                        'active' => false,
                        'block_carousel' => null,
                        'alias' => null,
                        'eu' => GetEUController::EU()
                    ];

                    $block_count--;
                    $i++;
                    $id++;
                }

                $blocks_karuseli = [];
                $j = 0;
                $productsWrap = [];

                foreach ($blocks as $i => $value) {
                    $products = DB::table('products')->select('product_id', 'product_img', 'product_title', 'product_price', 'product_sale', 'product_old_price')->where([
                        ['sex_id', $blocks[$i]['block_sex']],
                        ['categories_id','like', $blocks[$i]['block_cat'] === null ? '%' : $blocks[$i]['block_cat']],
                        ['departments_id', 'like', $blocks[$i]['block_dep'] === null ? '%' : $blocks[$i]['block_dep']]
                    ])->where('product_available', '=', 1)->orderBy('added_on', 'desc')->take(6)->get();
                    $blocks[$i]['alias'] = DB::table('sex')->where('sex_id', '=', $blocks[$i]['block_sex'])->value('sex_alias');
                    $blocks[$i]['block_carousel'] = $products;
                }
                $allblockinfo = [$main, $blocks];

                return $allblockinfo;
            }else{
                return [$main, [], []];
            }

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
            return true;
        }

        $id = $stringData["id"];

        if ($id === 1) {
            if ($request->hasFile("mainpage_main_img")) {
                Storage::makeDirectory(public_path() ."/img/baner-$id");

                $imgOldPath = $stringData['nameImg'];

                if (file_exists(public_path($imgOldPath)) && $imgOldPath !== null) {
                    unlink(public_path($imgOldPath));
                }

                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

                $name = substr(str_shuffle($permitted_chars), 0, 10);

                $img = $request->file("mainpage_main_img");
                $img->move(public_path() . "/img/baner-$id", $name . ".png");
                $imgPath = "/img/baner-$id/" . $name . ".png";
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
        }
        else{
            if (isset($stringData['removeBlock'])) {
                DB::table('mainpage')->where('mainpage_id' , '=', $id)->delete();
                File::deleteDirectory(public_path() ."/img/baner-$id");
                return true;
            }
            if ($request->hasFile("mainpage_main_img")) {

                Storage::makeDirectory(public_path() ."/img/baner-$id");

                $imgOldPath = $stringData['nameImg'];

                if (file_exists(public_path($imgOldPath)) && $imgOldPath !== null) {
                    unlink(public_path($imgOldPath));
                }

                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

                $name = substr(str_shuffle($permitted_chars), 0, 10);

                $img = $request->file("mainpage_main_img");
                $img->move(public_path() . "/img/baner-$id", $name . ".png");
                $imgPath = "/img/baner-$id/" . $name . ".png";
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_main_img' => $imgPath]);
                return true;
            }

            if (isset($stringData['mainpage_name'])) {
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_name' => $stringData['mainpage_name']]);
                return true;
            }

            if (isset($stringData['mainpage_block_sex'])){
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_block_sex' => $stringData['mainpage_block_sex']]);

                if (isset($stringData['mainpage_block_cat']) || $stringData['mainpage_block_cat'] === null){
                    DB::table('mainpage')
                        ->where('mainpage_id', $id)
                        ->update(['mainpage_block_cat' => $stringData['mainpage_block_cat']]);
                }
                if (isset($stringData['mainpage_block_dep']) || $stringData['mainpage_block_dep'] === null){
                    DB::table('mainpage')
                        ->where('mainpage_id', $id)
                        ->update(['mainpage_block_dep' => $stringData['mainpage_block_dep']]);
                }
                return true;
            }

            if (isset($stringData['mainpage_block_h1'])){
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_block_h1' => $stringData['mainpage_block_h1']]);
                return true;
            }

            if (isset($stringData['mainpage_block_sale'])){
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_block_sale' => $stringData['mainpage_block_sale']]);
                return true;
            }

            if (isset($stringData['mainpage_block_price'])){
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_block_price' => $stringData['mainpage_block_price']]);
                return true;
            }

            if (isset($stringData['mainpage_block_but_text'])) {
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_block_but_text' => $stringData['mainpage_block_but_text']]);
                return true;
            }
            if (isset($stringData['mainpage_block_but_href'])) {
                DB::table('mainpage')
                    ->where('mainpage_id', $id)
                    ->update(['mainpage_block_but_href' => $stringData['mainpage_block_but_href']]);
                return true;
            }
        }
    }
}
