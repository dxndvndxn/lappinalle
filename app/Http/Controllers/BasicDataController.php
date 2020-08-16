<?php

namespace App\Http\Controllers;

use DB;

class BasicDataController extends Controller
{
    public function index(){
        $categories = DB::table('categories_menu')->where('categories_menu_show', '=', 1)
        ->leftJoin('season', 'categories_menu.season_id', '=', 'season.season_id')
        ->leftJoin('categories', 'categories_menu.categories_id', '=', 'categories.categories_id')
        ->leftJoin('sex', 'categories_menu.sex_id', '=', 'sex.sex_id')
        ->leftJoin('departments_menu', 'departments_menu.categories_menu_id', '=', 'categories_menu.categories_menu_id')
        ->leftJoin('departments', 'departments_menu.departments_id', '=', 'departments.departments_id')
         ->get();
         $objectToArray = [];
         foreach ($categories as $catg){
             $newArr = (array)$catg;
             unset(
             $newArr['categories_menu_id'],
             $newArr['categories_menu_show'],
             $newArr['sex_id'],
             $newArr['categories_id'],
             $newArr['departments_id'],
             $newArr['departments_menu_id'],
             $newArr['season_id']
            );
             array_push($objectToArray, $newArr);
         }
        return $objectToArray;
    }
}
