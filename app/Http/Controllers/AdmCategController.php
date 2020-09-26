<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class AdmCategController extends Controller
{

    public function update(Request $request) {

        //Получение данных редактируемого раздела (ID, Новое название, Уровень вложенности, Пол, Категория, Раздел)
        $requestData = $request->all();

        if (isset($requestData['lvl'])) {
            DB::table($requestData['tableName'])
                ->where($requestData['tableNameId'], $requestData['menuItemId'])
                ->update([$requestData['tableFieldName'] =>$requestData['newGenderName']]);
            return true;
        }

        if (isset($requestData['alias'])) {
            if ($requestData['section'] === 'sex') {
                DB::table($requestData['section'])
                    ->where('sex_id', $requestData['sectionId'])
                    ->update(['sex_alias' => $requestData['newAlias']]);
                return true;
            }
            if ($requestData['section'] === 'categories') {
                DB::table($requestData['section'])
                    ->where('categories_id', $requestData['sectionId'])
                    ->update(['categories_alias' => $requestData['newAlias']]);
                return true;
            }
            if ($requestData['section'] === 'departments') {
                DB::table($requestData['section'])
                    ->where('departments_id', $requestData['sectionId'])
                    ->update(['departments_alias' => $requestData['newAlias']]);
                return true;
            }
        }

        if (isset($requestData['changePosition'])) {
            if (isset($requestData['sexId']) && $requestData['categId'] === null){
                DB::table('menu')
                    ->where('menu_id', $requestData['menuId'])
                    ->update(['sex_id' => $requestData['sexId']]);

                return true;
            }else{
                DB::table('menu')
                    ->where('menu_id', $requestData['menuId'])
                    ->update(['sex_id' => $requestData['sexId']])
                    ->update(['categories_id' => $requestData['categId']]);
                return true;
            }
        }
//        $menu = json_decode($requestData['data'], TRUE);
//        $menu_id = $menu['menu_id'];
//        $menu_name = $menu['menu_name'];
//        $menu_lvl = $menu['menu_lvl'];
//        $menu_sex = $menu['menu_sex'];
//        $menu_cat = $menu['menu_cat'];
//        $menu_dep = $menu['menu_dep'];


        // Изменение в таблице МЕНЮ значения пола
//        if (isset($menu['gender'])) {
//            DB::table('menu')
//                ->where('menu_id', $menu_id['menu_id'])
//                ->update(['sex_id' => $menu_sex['menu_sex']]);
//        }
//
//        //Изменение в таблице МЕНЮ значения категории
//        DB::table('menu')
//            ->where('menu_id', $menu_id['menu_id'])
//            ->update(['categories_id' => $menu_cat['menu_cat']]);
//
//        //Изменение в таблице МЕНЮ значения уровня вложенности
//        DB::table('menu')
//            ->where('menu_id', $menu_id['menu_id'])
//            ->update(['menu_lvlmenu' => $menu_lvl['menu_lvl']]);



        //Изменение в таблице SEX названия пола, если для редактирования выбран раздел 1 уровня
//        if ($menu_lvl == 1) {
//            DB::table('sex')
//                ->where('sex_id', $menu_sex['menu_sex'])
//                ->update(['sex_name' => $menu_name['menu_name']]);
//        }
//
//        //Изменение в таблице CATEGORIES названия категории, если для редактирования выбран раздел 2 уровня
//        if ($menu_lvl == 2) {
//
//            DB::table('categories')
//                ->where('categories_id', $menu_cat['menu_cat'])
//                ->update(['categories_name' => $menu_name['menu_name']]);
//        }
//
//        //Изменение в таблице DEPARTMENTS названия пола, если для редактирования выбран раздел 3 уровня
//        if ($menu_lvl == 3) {
//
//            DB::table('departments')
//                ->where('departments_id', $menu_dep['menu_dep'])
//                ->update(['departments_name' => $menu_name['menu_name']]);
//        }
    }


    // Добавление нового пола
    public function newsex(Request $request) {

        DB::table('sex')
            ->insert(
                [
                    'sex_name' => 'Новый раздел',
                    'sex_alias' => 'новый алиас'
                ]
            );

        $lastSexId = DB::table('sex')->select('sex_id')->orderBy('sex_id', 'desc')->value('sex_id');

        DB::table('menu')
            ->insert(
              [
                    'menu_lvlmenu' => 1,
                    'sex_id' => $lastSexId
              ]
            );
        return true;
    }

    // Добавление новой категории
    public function newcat(Request $request) {
        $sexId = $request->only('sexId');

        DB::table('categories')
            ->insert(
                [
                    'categories_name' => 'Новый раздел',
                    'categories_alias' => 'newcategory'
                ]
            );

        $lastCatId = DB::table('categories')->select('categories_id')->orderBy('categories_id', 'desc')->value('categories_id');

        DB::table('menu')
            ->insert(
                [
                    'menu_lvlmenu' => 2,
                    'sex_id' => $sexId['sexId'],
                    'categories_id' => $lastCatId
                ]
            );

    }

    // Добавление нового раздела
    public function newdep(Request $request) {
        $sexId = $request->only('sexId');
        $catId = $request->only('catId');

        DB::table('departments')
            ->insert(
                [
                    'departments_name' => 'Новый раздел',
                    'departments_alias' => 'newdepartments'
                ]
            );

        $lastDepId = DB::table('departments')->select('departments_id')->orderBy('departments_id', 'desc')->value('departments_id');

        DB::table('menu')
            ->insert(
                [
                    'menu_lvlmenu' => 3,
                    'sex_id' => $sexId['sexId'],
                    'categories_id' => $catId['catId'],
                    'departments_id' => $lastDepId
                ]
            );

    }
}
