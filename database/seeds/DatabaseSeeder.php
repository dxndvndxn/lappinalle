<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

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
            ['categories_name' => 'Верхняя одежда Зима', 'categories_alias' => 'verhodejda-zima'],
            ['categories_name' => 'Верхняя одежда Весна/Осень', 'categories_alias' => 'verhodejda-vesnaosen'],
            ['categories_name' => 'Аксессуары Зима', 'categories_alias' => 'aksessuari-zima'],
            ['categories_name' => 'Аксессуары Весна/Осень', 'categories_alias' => 'aksessuari-vesnaosen'],
            ['categories_name' => 'Промежуточный слой', 'categories_alias' => 'promezhutochnisloi'],
            ['categories_name' => 'Защита от воды и грязи (прорезиненная одежда)', 'categories_alias' => 'prorezinenajaodejda'],
            ['categories_name' => 'Обувь', 'categories_alias' => 'obuv'],
            ['categories_name' => 'Трикотаж', 'categories_alias' => 'trikotaj'],
            ['categories_name' => 'Распродажа', 'categories_alias' => 'sale']
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
        DB::table('menu')->insert([
            // Мальчики, девочки
            ['menu_lvlmenu' => 1, 'sex_id' => 1, 'categories_id' => null, 'departments_id' => null ],
            ['menu_lvlmenu' => 1, 'sex_id' => 2, 'categories_id' => null, 'departments_id' => null],

            // КАТЕГОРИИ
            // Верхняя одежда Зима
            ['menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 1, 'departments_id' => null],
            ['menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 1, 'departments_id' => null],

            // Верхняя одежда Весна/Осень
            ['menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 2, 'departments_id' => null],
            ['menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 2, 'departments_id' => null],

            // Акссесуары Зима
            ['menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 3, 'departments_id' => null],
            ['menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 3, 'departments_id' => null],

            // Акссесуары Весна/Осень
            ['menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 4, 'departments_id' => null],
            ['menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 4, 'departments_id' => null],

            // Промежуточный слой
            ['menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 5, 'departments_id' => null],
            ['menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 5, 'departments_id' => null],

            // Защита грязи и воды
            ['menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 6, 'departments_id' => null],
            ['menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 6, 'departments_id' => null],

            // Обувь
            ['menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 7, 'departments_id' => null],
            ['menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 7, 'departments_id' => null],

            // Трикотаж
            ['menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 8, 'departments_id' => null],
            ['menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 8, 'departments_id' => null],

            // Распродажа
            ['menu_lvlmenu' => 2, 'sex_id' => 1, 'categories_id' => 9, 'departments_id' => null],
            ['menu_lvlmenu' => 2, 'sex_id' => 2, 'categories_id' => 9, 'departments_id' => null],

            // ПОДКАТЕГОРИИ
            // Верхняя одежда Зима Комбинезоны
            ['menu_lvlmenu' => 3, 'sex_id' => 1, 'categories_id' => 1, 'departments_id' => 1],
            ['menu_lvlmenu' => 3, 'sex_id' => 2, 'categories_id' => 1, 'departments_id' => 1],

            // Верхняя одежда Весна/Осень Комбинезоны
            ['menu_lvlmenu' => 3, 'sex_id' => 1, 'categories_id' => 2, 'departments_id' => 1],
            ['menu_lvlmenu' => 3, 'sex_id' => 2, 'categories_id' => 2, 'departments_id' => 1],

            // Верхняя одежда Зима Куртки/парки
            ['menu_lvlmenu' => 3, 'sex_id' => 1, 'categories_id' => 1, 'departments_id' => 2],
            ['menu_lvlmenu' => 3, 'sex_id' => 2, 'categories_id' => 1, 'departments_id' => 2],

            // Верхняя одежда Весна/Осень Куртки/парки
            ['menu_lvlmenu' => 3, 'sex_id' => 1, 'categories_id' => 2, 'departments_id' => 2],
            ['menu_lvlmenu' => 3, 'sex_id' => 2, 'categories_id' => 2, 'departments_id' => 2],

            // Акссесуары Зима Шапки
            ['menu_lvlmenu' => 3, 'sex_id' => 1, 'categories_id' => 3, 'departments_id' => 7],
            ['menu_lvlmenu' => 3, 'sex_id' => 2, 'categories_id' => 3, 'departments_id' => 7],

            // Акссесуары Зима Шлемы
            ['menu_lvlmenu' => 3, 'sex_id' => 1, 'categories_id' => 3, 'departments_id' => 8],
            ['menu_lvlmenu' => 3, 'sex_id' => 2, 'categories_id' => 3, 'departments_id' => 8],

            // Акссесуары Весна/Осень Шапки
            ['menu_lvlmenu' => 3, 'sex_id' => 1, 'categories_id' => 4, 'departments_id' => 7],
            ['menu_lvlmenu' => 3, 'sex_id' => 2, 'categories_id' => 4, 'departments_id' => 7],

            // Акссесуары Весна/Осень Шлемы
            ['menu_lvlmenu' => 3, 'sex_id' => 1, 'categories_id' => 4, 'departments_id' => 8],
            ['menu_lvlmenu' => 3, 'sex_id' => 2, 'categories_id' => 4, 'departments_id' => 8],

            // Промежуточный слой термобелье
            ['menu_lvlmenu' => 3, 'sex_id' => 1, 'categories_id' => 5, 'departments_id' => 3],
            ['menu_lvlmenu' => 3, 'sex_id' => 2, 'categories_id' => 5, 'departments_id' => 3],

            // Промежуточный слой флис
            ['menu_lvlmenu' => 3, 'sex_id' => 1, 'categories_id' => 5, 'departments_id' => 4],
            ['menu_lvlmenu' => 3, 'sex_id' => 2, 'categories_id' => 5, 'departments_id' => 4],

            // Защита грязи и воды куртки/парки
            ['menu_lvlmenu' => 3, 'sex_id' => 1, 'categories_id' => 6, 'departments_id' => 2],
            ['menu_lvlmenu' => 3, 'sex_id' => 2, 'categories_id' => 6, 'departments_id' => 2],

            // Защита грязи и воды краги
            ['menu_lvlmenu' => 3, 'sex_id' => 1, 'categories_id' => 6, 'departments_id' => 5],
            ['menu_lvlmenu' => 3, 'sex_id' => 2, 'categories_id' => 6, 'departments_id' => 5],

            // Защита грязи и воды куртки/парки
            ['menu_lvlmenu' => 3, 'sex_id' => 1, 'categories_id' => 6, 'departments_id' => 6],
            ['menu_lvlmenu' => 3, 'sex_id' => 2, 'categories_id' => 6, 'departments_id' => 6],

            // Обувь сапоги
            ['menu_lvlmenu' => 3, 'sex_id' => 1, 'categories_id' => 7, 'departments_id' => 9],
            ['menu_lvlmenu' => 3, 'sex_id' => 2, 'categories_id' => 7, 'departments_id' => 9],

            // Обувь кеды
            ['menu_lvlmenu' => 3, 'sex_id' => 1, 'categories_id' => 7, 'departments_id' => 10],
            ['menu_lvlmenu' => 3, 'sex_id' => 2, 'categories_id' => 7, 'departments_id' => 10],
        ]);

        DB::table('delivery')->insert(
            [ 'delivery_name' => 'Курьерская доставка',
                'delivery_confirm' => true
            ]);

        DB::table('delivery')->insert(
            [ 'delivery_name' => 'Почта России',
                'delivery_confirm' => true
            ]);

        DB::table('delivery')->insert(
            [ 'delivery_name' => 'СДЭК',
                'delivery_confirm' => true
            ]
        );

        DB::table('delivery')->insert(
            [ 'delivery_name' => 'ПЭК',
                'delivery_confirm' => true
            ]);
        DB::table('products')->insert([
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],[
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test',
                'product_price' => rand(10, 90),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 0,
                'product_old_price' => null,
                'product_video' => '../img/video_1'
            ],
               [
                   'product_title' => 'Test2',
                   'product_price' => 40,
                   'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                   'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                   'sex_id' => 1,
                   'categories_id' => 1,
                   'departments_id' => 2,
                   'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                   'product_sale' => 1,
                   'product_old_price' => 50,
                   'product_video' => '../img/video_1'
               ],
            [
                'product_title' => 'Test2',
                'product_price' => 40,
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => 40,
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => rand(20, 49),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => rand(20, 49),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => 40,
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => 40,
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => 40,
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => 40,
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => 40,
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => 40,
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => rand(20, 49),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => rand(20, 49),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => 40,
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => rand(20, 49),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => 40,
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/img_1-item-1.png, ../img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '../img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => rand(20, 49),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '/img/img_1-item-1.png, /img/img_1-item-2.png, /img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '/img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => 40,
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '/img/img_1-item-1.png, /img/img_1-item-2.png, ../img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '/img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => 40,
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '/img/img_1-item-1.png, /img/img_1-item-2.png, /img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '/img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => 40,
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '/img/img_1-item-1.png, /img/img_1-item-2.png, /img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '/img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => rand(20, 49),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '/img/img_1-item-1.png, /img/img_1-item-2.png, /img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '/img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => 40,
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '/img/img_1-item-1.png, /img/img_1-item-2.png, /img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '/img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => rand(20, 49),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '/img/img_1-item-1.png, /img/img_1-item-2.png, /img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '/img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => 40,
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '/img/img_1-item-1.png, /img/img_1-item-2.png, /img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '/img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => rand(20, 49),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '/img/img_1-item-1.png, /img/img_1-item-2.png, /img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '/img/video_1'
            ],
            [
                'product_title' => 'Test2',
                'product_price' => rand(20, 49),
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '/img/img_1-item-1.png, /img/img_1-item-2.png, /img/img_3-item-1.png',
                'sex_id' => 1,
                'categories_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 1,
                'product_old_price' => 50,
                'product_video' => '/img/video_1'
            ],

        ]);
        DB::table('sizes')->insert([
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)],
            ['sizes_number' => rand(1, 130)]
        ]);
        DB::table('catalog_size')->insert([
            [
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],
            [
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],
            [
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],
            [
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],
            [
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],
            [
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],
            [
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],
            [
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],
            [
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],
            [
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],[
                'catalog_size_amount' => rand(1, 130),
                'product_id' => rand(1, 91),
                'sizes_id' => rand(1, 50)
            ],
        ]);
    }
}
