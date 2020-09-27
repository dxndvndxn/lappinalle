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

                if (count($requestData['departmentsIds'])) {
                    DB::table('menu')
                        ->whereIn('menu_id', $requestData['departmentsIds'])
                        ->update(['sex_id' => $requestData['sexId']]);
                }
                return true;
            }else{
                DB::table('menu')
                    ->where('menu_id', $requestData['menuId'])
                    ->update(['sex_id' => $requestData['sexId']]);
                DB::table('menu')
                    ->where('menu_id', $requestData['menuId'])
                    ->update(['categories_id' => $requestData['categId']]);
                return true;
            }
        }

        if (isset($requestData['deleteSection'])) {
            if ($requestData['lvlForDelete'] === 1) {
                DB::table('sex')->where('sex_id', '=', $requestData['activeIdForAllTables'])->delete();
                return true;
            }
            if ($requestData['lvlForDelete'] === 2) {
                DB::table('categories')->where('categories_id', '=', $requestData['activeIdForAllTables'])->delete();
                return true;
            }
            if ($requestData['lvlForDelete'] === 3) {
                DB::table('departments')->where('departments_id', '=', $requestData['activeIdForAllTables'])->delete();
                return true;
            }
        }
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
