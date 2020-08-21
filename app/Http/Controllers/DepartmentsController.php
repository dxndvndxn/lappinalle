<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DepartmentsController extends Controller
{
    public function index(Request $request, $genders, $categories, $departments)
    {
        // Находим в категориях тире (aksessuari-vesnaosen) и разделяем его на (aksessuari, vesnaosen)
        $regxp = '/(-)/';
        $parts = preg_split($regxp, $categories);

        // Узнаем какой гендер нужен
        $sexId = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $genders)->get();
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
        $arrayOfProducts = [];
        switch (count($parts)) {
            case 1:
                $dataByDepart = DB::table('products')->select("product_id", "product_title", "product_price", "product_description", "product_img", "product_old_price")
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newGen['sex_id'])
                    ->where('categories_id', '=', $newCateg['categories_id'])
                    ->where('departments_id', '=', $newDepart['departments_id'])
                    ->orderBy('product_id', 'desc')
                    ->paginate(30);

                // Получаем мин стоимость
                $productMin =  DB::table('products')
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newGen['sex_id'])
                    ->where('categories_id', '=', $newCateg['categories_id'])
                    ->where('departments_id', '=', $newDepart['departments_id'])
                    ->min('product_price');

                // Получаем макс стоимость
                $productMax =  DB::table('products')
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newGen['sex_id'])
                    ->where('categories_id', '=', $newCateg['categories_id'])
                    ->where('departments_id', '=', $newDepart['departments_id'])
                    ->max('product_price');

                $dataByDepart['max'] = $productMax;
                $dataByDepart['min'] = $productMin;

                return  $dataByDepart;
            case 2:
                $seasonId = DB::table('season')->select("season_id")->where('season_alias', '=', $parts[1])->get();
                $newSeason = null;

                foreach ($seasonId as $val) {
                    $newSeason = (array)$val;
                }

                $dataByDepart = DB::table('products')->select("product_id", "product_title", "product_price", "product_description", "product_img", "product_old_price")
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newGen['sex_id'])
                    ->where('categories_id', '=', $newCateg['categories_id'])
                    ->where('season_id', '=', $newSeason['season_id'])
                    ->where('departments_id', '=', $newDepart['departments_id'])
                    ->orderBy('product_id', 'desc')
                    ->paginate(30);

                // Получаем мин стоимость
                $productMin =  DB::table('products')
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newGen['sex_id'])
                    ->where('season_id', '=', $newSeason['season_id'])
                    ->where('categories_id', '=', $newCateg['categories_id'])
                    ->where('departments_id', '=', $newDepart['departments_id'])
                    ->min('product_price');

                // Получаем макс стоимость
                $productMax =  DB::table('products')
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newGen['sex_id'])
                    ->where('season_id', '=', $newSeason['season_id'])
                    ->where('departments_id', '=', $newDepart['departments_id'])
                    ->where('categories_id', '=', $newCateg['categories_id'])
                    ->max('product_price');

                $dataByDepart['max'] = $productMax;
                $dataByDepart['min'] = $productMin;

                return $dataByDepart;
            default:
                return false;
        }
    }
}
