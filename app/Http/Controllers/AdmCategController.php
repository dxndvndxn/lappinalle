<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class AdmCategController extends Controller
{
    private $letters = array(
        'а' => 'a',   	'б' => 'b',     'в' => 'v',
        'г' => 'g',   	'д' => 'd',   	'е' => 'e',
        'ё' => 'e',   	'ж' => 'zh',  	'з' => 'z',
        'и' => 'i',   	'й' => 'y',   	'к' => 'k',
        'л' => 'l',   	'м' => 'm',   	'н' => 'n',
        'о' => 'o',   	'п' => 'p',   	'р' => 'r',
        'с' => 's',   	'т' => 't',   	'у' => 'u',
        'ф' => 'f',   	'х' => 'h',   	'ц' => 'c',
        'ч' => 'ch',  	'ш' => 'sh',  	'щ' => 'sch',
        'ь' => '',   	'ы' => 'y',   	'ъ' => '',
        'э' => 'e',   	'ю' => 'yu',  	'я' => 'ya',
        'А' => 'A',   	'Б' => 'B',   	'В' => 'V',
        'Г' => 'G',   	'Д' => 'D',   	'Е' => 'E',
        'Ё' => 'E',   	'Ж' => 'Zh',  	'З' => 'Z',
        'И' => 'I',   	'Й' => 'Y',   	'К' => 'K',
        'Л' => 'L',   	'М' => 'M',   	'Н' => 'N',
        'О' => 'O',   	'П' => 'P',   	'Р' => 'R',
        'С' => 'S',   	'Т' => 'T',   	'У' => 'U',
        'Ф' => 'F',   	'Х' => 'H',   	'Ц' => 'C',
        'Ч' => 'Ch',  	'Ш' => 'Sh',  	'Щ' => 'Sch',
        'Ь' => '',  	'Ы' => 'Y',   	'Ъ' => '_',
        'Э' => 'E',   	'Ю' => 'Yu',  	'Я' => 'Ya',
        'є' => 'ye', 	'ї' => 'yi', 	'і' => 'i',
        'Є' => 'YE', 	'Ї' => 'YI', 	'І' => 'I',
        ' ' => '_'
    );

    public function update(Request $request) {

        //Получение данных редактируемого раздела (ID, Новое название, Уровень вложенности, Пол, Категория, Раздел)
        $requestData = $request->all();
        $menu = json_decode($requestData['data'], TRUE);
        $menu_id = $menu['menu_id'];
        $menu_name = $menu['menu_name'];
        $menu_lvl = $menu['menu_lvl'];
        $menu_sex = $menu['menu_sex'];
        $menu_cat = $menu['menu_cat'];
        $menu_dep = $menu['menu_dep'];


        // Изменение в таблице МЕНЮ значения пола
        if (isset($menu['gender'])) {
            DB::table('menu')
                ->where('menu_id', $menu_id['menu_id'])
                ->update(['sex_id' => $menu_sex['menu_sex']]);
        }

        //Изменение в таблице МЕНЮ значения категории
        DB::table('menu')
            ->where('menu_id', $menu_id['menu_id'])
            ->update(['categories_id' => $menu_cat['menu_cat']]);

        //Изменение в таблице МЕНЮ значения уровня вложенности
        DB::table('menu')
            ->where('menu_id', $menu_id['menu_id'])
            ->update(['menu_lvlmenu' => $menu_lvl['menu_lvl']]);



        //Изменение в таблице SEX названия пола, если для редактирования выбран раздел 1 уровня
        if ($menu_lvl == 1) {

            DB::table('sex')
                ->where('sex_id', $menu_sex['menu_sex'])
                ->update(['sex_name' => $menu_name['menu_name']]);
        }

        //Изменение в таблице CATEGORIES названия категории, если для редактирования выбран раздел 2 уровня
        if ($menu_lvl == 2) {

            DB::table('categories')
                ->where('categories_id', $menu_cat['menu_cat'])
                ->update(['categories_name' => $menu_name['menu_name']]);
        }

        //Изменение в таблице DEPARTMENTS названия пола, если для редактирования выбран раздел 3 уровня
        if ($menu_lvl == 3) {

            DB::table('departments')
                ->where('departments_id', $menu_dep['menu_dep'])
                ->update(['departments_name' => $menu_name['menu_name']]);
        }
    }


    // Добавление нового пола
    public function newsex(Request $request) {

        DB::table('sex')
            ->insert(
                [
                    'sex_name' => 'Новый раздел',
                    'sex_alias' => 'хуй'
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

        DB::table('categories')->insert(['categories_name' => 'Новый раздел',
            'categories_alias' => 'newcategory']);

    }

    // Добавление нового раздела
    public function newdep(Request $request) {

        DB::table('departments')->insert(['departments_name' => 'Новый раздел',
            'departments_alias' => 'newdepartments']);

    }
}
