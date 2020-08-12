<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['categories_name' => 'Мальчики', 'categories_alias' => 'malchiki'],
            ['categories_name' => 'Девочки', 'categories_alias' => 'devochki'],
            ['categories_name' => 'Верхняя одежда', 'categories_alias' => 'verhodejda'],
            ['categories_name' => 'Аксессуары', 'categories_alias' => 'aksessuari'],
            ['categories_name' => 'Промежуточный слой','categories_alias' => 'promezhutochni-sloi'],
            ['categories_name' => 'Защита от воды и грязи (прорезиненная одежда)', 'categories_alias' => 'prorezinenajaodejda'],
            ['categories_name' => 'Обувь', 'categories_alias' => 'obuv'],
            ['categories_name' => 'Трикотаж', 'categories_alias' => 'trikotaj'],
            ['categories_name' => 'Распродажа', 'categories_alias' => 'sale']
        ]);
        DB::table('season')->insert([
            ['season_name' => 'Зима', 'season_alias' => 'zima'],
            ['season_name' => 'Весна/Осень', 'season_alias' => 'vesna-osen']
        ]);
        DB::table('sex')->insert([
            ['sex_name' => 'Мальчики', 'sex_alias' => 'malchiki'],
            ['sex_name' => 'Девочки', 'sex_alias' => 'devochki']
        ]);
        DB::table('departments')->insert([
            ['departments_name' => 'Комбинезоны', 'departments_alias' => 'kombinezoni'],
            ['departments_name' => 'Куртки, парки', 'departments_alias' => 'kurtkiparki'],
            ['departments_name' => 'Термобельё', 'departments_alias' => 'termobelio'],
            ['departments_name' => 'Флис', 'departments_alias' => 'flis'],
            ['departments_name' => 'Краги', 'departments_alias' => 'kragi'],
            ['departments_name' => 'Резиновые сапоги', 'departments_alias' => 'rezinoviesapogi'],
            ['departments_name' => 'Шапки', 'departments_alias' => 'chapki'],
            ['departments_name' => 'Шлемы', 'departments_alias' => 'chlemi'],
            ['departments_name' => 'Сапоги', 'departments_alias' => 'sapogi'],
            ['departments_name' => 'Кеды', 'departments_alias' => 'kedi'],
        ]);
        DB::table('categories_menu')->insert([
            // Мальчики, девочки
            ['categories_menu_lvlmenu' => 1, 'categories_id' => 1],
            ['categories_menu_lvlmenu' => 1, 'categories_id' => 2],
        ]);
        DB::table('categories_menu')->insert([
            // Верхняя одежда
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 3, 'season_id' => 1],
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 3, 'season_id' => 1],
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 3, 'season_id' => 2],
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 3, 'season_id' => 2],
            // Акссесуары
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 4, 'season_id' => 1],
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 4, 'season_id' => 1],
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 4, 'season_id' => 2],
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 4, 'season_id' => 2],
        ]);
        DB::table('categories_menu')->insert([
            // Промежуточный слой
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 5],
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 5],
            // Защита грязи и воды
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 6],
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 6],
            // Обувь
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 7],
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 7],
            // Трикотаж
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 8],
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 8],
            // Распродажа
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 9],
            ['categories_menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 9],
        ]);
        DB::table('departments_menu')->insert([
            // Комбинезоны
            ['departments_id' => 1, 'categories_menu_id' => 3],
            ['departments_id' => 1, 'categories_menu_id' => 4],
            ['departments_id' => 1, 'categories_menu_id' => 5],
            ['departments_id' => 1, 'categories_menu_id' => 6],
            // Куртки и парки
            ['departments_id' => 2, 'categories_menu_id' => 3],
            ['departments_id' => 2, 'categories_menu_id' => 4],
            ['departments_id' => 2, 'categories_menu_id' => 5],
            ['departments_id' => 2, 'categories_menu_id' => 6],
            ['departments_id' => 2, 'categories_menu_id' => 13],
            ['departments_id' => 2, 'categories_menu_id' => 14],
            // Термобелье
            ['departments_id' => 3, 'categories_menu_id' => 11],
            ['departments_id' => 3, 'categories_menu_id' => 12],
            // Флис
            ['departments_id' => 4, 'categories_menu_id' => 11],
            ['departments_id' => 4, 'categories_menu_id' => 12],
            // Краги
            ['departments_id' => 5, 'categories_menu_id' => 13],
            ['departments_id' => 5, 'categories_menu_id' => 14],
            // Резиновые сапоги
            ['departments_id' => 6, 'categories_menu_id' => 13],
            ['departments_id' => 6, 'categories_menu_id' => 14],
            // Шапки
            ['departments_id' => 7, 'categories_menu_id' => 7],
            ['departments_id' => 7, 'categories_menu_id' => 8],
            ['departments_id' => 7, 'categories_menu_id' => 9],
            ['departments_id' => 7, 'categories_menu_id' => 10],
            // Шлемы
            ['departments_id' => 8, 'categories_menu_id' => 7],
            ['departments_id' => 8, 'categories_menu_id' => 8],
            ['departments_id' => 8, 'categories_menu_id' => 9],
            ['departments_id' => 8, 'categories_menu_id' => 10],
            // Сапоги
            ['departments_id' => 9, 'categories_menu_id' => 15],
            ['departments_id' => 9, 'categories_menu_id' => 16],
            // Кеды
            ['departments_id' => 10, 'categories_menu_id' => 15],
            ['departments_id' => 10, 'categories_menu_id' => 16],
        ]);

        DB::table('product')->insert([
            [
                'product_title' => 'Комбинезон Lappinalle',
                'product_price' => '999999',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.'],
                 'product_img' => 'img/item.png',
                 'product_amount' => 67,
                 'sex_id' => 1,
                 'categories_id' => 3,
            ]);
    }
}
