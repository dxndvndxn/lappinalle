<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoriesController extends Controller
{
    public function index(Request $request, $genders, $categories){
        $regxp = '/(-)/';
        $parts = preg_split($regxp, $categories);

        $sexId = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $genders)->get();
        $newGen = null;

        foreach ($sexId as $val){
            $newGen = (array) $val;
        }

        $categoryId = DB::table('categories')->select("categories_id")->where('categories_alias', '=', $parts[0])->get();
        $newCateg = null;

        foreach ($categoryId as $val){
            $newCateg = (array) $val;
        }

        switch (count($parts)){
            case 1:
                $dataByGender = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_sale")
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newGen['sex_id'])
                    ->where('categories_id', '=', $newCateg['categories_id'])
                    ->get();
                return $dataByGender;
            case 2:
                $seasonId = DB::table('season')->select("season_id")->where('season_alias', '=', $parts[1])->get();
                $newSeason = null;

                foreach ($seasonId as $val){
                    $newSeason = (array) $val;
                }

                $dataByGender = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_sale")
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newGen['sex_id'])
                    ->where('categories_id', '=', $newCateg['categories_id'])
                    ->where('season_id', '=', $newSeason['season_id'])
                    ->get();
                return $dataByGender;
        }
    }
}
