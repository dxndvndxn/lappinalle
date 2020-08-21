<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GetDataFromDepartSortPriceController extends Controller
{
    public function index(Request $request, $where, $gender, $categories, $departments){
        // Находим в категориях тире (aksessuari-vesnaosen) и разделяем его на (aksessuari, vesnaosen)
        $regxp = '/(-)/';
        $parts = preg_split($regxp, $categories);

        // Получаем гендер id
        $sexId = DB::table('sex')->select("sex_id")->where('sex_alias', '=', $gender)->get();
        $newGen = null;

        // Преобразовываем к обрабатываемомму виду
        foreach ($sexId as $val){
            $newGen = (array) $val;
        }

        // Узнаем какие категория нужна
        $categoryId = DB::table('categories')->select("categories_id")->where('categories_alias', '=', $parts[0])->get();
        $newCateg = null;

        foreach ($categoryId as $val){
            $newCateg = (array) $val;
        }

        // Узнаем какие подкатегории нужны
        $departmentsId = DB::table('departments')->select("departments_id")->where('departments_alias', '=', $departments)->get();
        $newDepart = null;

        foreach ($departmentsId as $val) {
            $newDepart = (array)$val;
        }

        // Проверяем условие, если длина массива $parts = 1, то делаем запрос по гендеру и категории без сезона
        // если длина массива $parts = 2, то делаем запрос по гендеру и по категории плюс сезон
        switch (count($parts)){
            case 1:

                switch ($where){
                    case 'low':
                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
                            ->where('product_available', '=', 1)
                            ->where('sex_id', '=', $newGen['sex_id'])
                            ->where('categories_id', '=', $newCateg['categories_id'])
                            ->where('departments_id', '=', $newDepart['departments_id'])
                            ->orderBy('product_price', 'asc')
                            ->paginate(30);
                        break;
                    case 'high':
                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
                            ->where('product_available', '=', 1)
                            ->where('sex_id', '=', $newGen['sex_id'])
                            ->where('categories_id', '=', $newCateg['categories_id'])
                            ->where('departments_id', '=', $newDepart['departments_id'])
                            ->orderBy('product_price', 'desc')
                            ->paginate(30);
                        break;
                }
                // Получаем мин стоимость
                $productMin = DB::table('products')
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newGen['sex_id'])
                    ->where('departments_id', '=', $newDepart['departments_id'])
                    ->where('categories_id', '=', $newCateg['categories_id'])
                    ->min('product_price');

                // Получаем макс стоимость
                $productMax =  DB::table('products')
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newGen['sex_id'])
                    ->where('departments_id', '=', $newDepart['departments_id'])
                    ->where('categories_id', '=', $newCateg['categories_id'])
                    ->max('product_price');

                $sortData['max'] = $productMax;
                $sortData['min'] = $productMin;

                return $sortData;
            case 2:
                $seasonId = DB::table('season')->select("season_id")->where('season_alias', '=', $parts[1])->get();
                $newSeason = null;

                foreach ($seasonId as $val){
                    $newSeason = (array) $val;
                }

                switch ($where){
                    case 'low':
                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
                            ->where('product_available', '=', 1)
                            ->where('sex_id', '=', $newGen['sex_id'])
                            ->where('categories_id', '=', $newCateg['categories_id'])
                            ->where('departments_id', '=', $newDepart['departments_id'])
                            ->where('season_id', '=', $newSeason['season_id'])
                            ->orderBy('product_price', 'asc')
                            ->paginate(30);
                        break;
                    case 'high':
                        $sortData = DB::table('products')->select("product_id","product_title", "product_price", "product_description", "product_img", "product_old_price")
                            ->where('product_available', '=', 1)
                            ->where('sex_id', '=', $newGen['sex_id'])
                            ->where('categories_id', '=', $newCateg['categories_id'])
                            ->where('departments_id', '=', $newDepart['departments_id'])
                            ->where('season_id', '=', $newSeason['season_id'])
                            ->orderBy('product_price', 'desc')
                            ->paginate(30);
                        break;
                }

                // Получаем мин стоимость
                $productMin = DB::table('products')
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newGen['sex_id'])
                    ->where('categories_id', '=', $newCateg['categories_id'])
                    ->where('departments_id', '=', $newDepart['departments_id'])
                    ->where('season_id', '=', $newSeason['season_id'])
                    ->min('product_price');

                // Получаем макс стоимость
                $productMax = DB::table('products')
                    ->where('product_available', '=', 1)
                    ->where('sex_id', '=', $newGen['sex_id'])
                    ->where('categories_id', '=', $newCateg['categories_id'])
                    ->where('departments_id', '=', $newDepart['departments_id'])
                    ->where('season_id', '=', $newSeason['season_id'])
                    ->max('product_price');

                $sortData['max'] = $productMax;
                $sortData['min'] = $productMin;

                return $sortData;
            default:
                return false;
        }
    }
}
