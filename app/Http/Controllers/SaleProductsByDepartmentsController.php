<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SaleProductsByDepartmentsController extends Controller
{
    public function index(Request $request, $gender, $categories, $departments){
        // Находим в категориях тире (aksessuari-vesnaosen) и разделяем его на (aksessuari, vesnaosen)
        $regxp = '/(-)/';
        $parts = preg_split($regxp, $categories);

        // Узнаем какой гендер нужен
        $sexId = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $gender)->get();
        $newGen = null;

        foreach ($sexId as $val) {
            $newGen = (array)$val;
        }

        // Узнаем какие категории нужны
        $categoryId = DB::table('categories')->select("categories_id")->where('categories_alias', '=', $parts[0])->get();
        $newCateg = null;

        foreach ($categoryId as $val) {
            $newCateg = (array)$val;
        }

        // Узнаем какие подкатегории нужны
        $departmentsId = DB::table('departments')->select("departments_id")->where('departments_alias', '=', $departments)->get();
        $newDepart = null;

        foreach ($departmentsId as $val) {
            $newDepart = (array)$val;
        }

        // Проверяем условие, если длина массива $parts = 1, то делаем запрос по гендеру и категории без сезона
        // если длина массива $parts = 2, то делаем запрос по гендеру и по категории плюс сезон
        switch (count($parts)) {
            case 1:
                $dataByGender = DB::table('products')->select("product_id", "product_title", "product_price", "product_description", "product_img", "product_sale")
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newGen['sex_id'])
                    ->where('categories_id', '=', $newCateg['categories_id'])
                    ->where('departments_id', '=', $newDepart['departments_id'])
                    ->whereNotNull('product_sale')
                    ->orderBy('product_id', 'desc')
                    ->paginate(30);
                return $dataByGender;
            case 2:
                $seasonId = DB::table('season')->select("season_id")->where('season_alias', '=', $parts[1])->get();
                $newSeason = null;

                foreach ($seasonId as $val) {
                    $newSeason = (array)$val;
                }

                $dataByGender = DB::table('products')->select("product_id", "product_title", "product_price", "product_description", "product_img", "product_sale")
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newGen['sex_id'])
                    ->where('categories_id', '=', $newCateg['categories_id'])
                    ->where('season_id', '=', $newSeason['season_id'])
                    ->where('departments_id', '=', $newDepart['departments_id'])
                    ->whereNotNull('product_sale')
                    ->orderBy('product_id', 'desc')
                    ->paginate(30);
                return $dataByGender;
            default:
                return false;
        }
    }
}
