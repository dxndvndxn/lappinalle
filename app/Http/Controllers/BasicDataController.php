<?php

namespace App\Http\Controllers;

use DB;

class BasicDataController extends Controller
{
    public function index(){
        $getMenu = DB::table('menu')
        ->leftJoin('categories', 'menu.categories_id', '=', 'categories.categories_id')
            ->leftJoin('sex', 'menu.sex_id', '=', 'sex.sex_id')
            ->leftJoin('departments', 'menu.departments_id', '=', 'departments.departments_id')
            ->select('menu.sex_id', 'menu.categories_id', 'menu.departments_id', 'categories.categories_name', 'categories.categories_alias', 'sex.sex_name', 'sex.sex_alias','departments.departments_name','departments.departments_alias','menu_lvlmenu')
         ->get();

         $menu = [];
         foreach ($getMenu as $mn){
             array_push($menu, (array)$mn);
         }
        return $menu;
    }
}
