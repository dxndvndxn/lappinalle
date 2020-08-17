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
            ['categories_name' => 'Мальчики', 'categories_alias' => 'malchiki'],
            ['categories_name' => 'Девочки', 'categories_alias' => 'devochki'],
            ['categories_name' => 'Верхняя одежда', 'categories_alias' => 'verhodejda'],
            ['categories_name' => 'Аксессуары', 'categories_alias' => 'aksessuari'],
            ['categories_name' => 'Промежуточный слой','categories_alias' => 'promezhutochnisloi'],
            ['categories_name' => 'Защита от воды и грязи (прорезиненная одежда)', 'categories_alias' => 'prorezinenajaodejda'],
            ['categories_name' => 'Обувь', 'categories_alias' => 'obuv'],
            ['categories_name' => 'Трикотаж', 'categories_alias' => 'trikotaj'],
            ['categories_name' => 'Распродажа', 'categories_alias' => 'sale']
        ]);
        DB::table('season')->insert([
            ['season_name' => 'Зима', 'season_alias' => 'zima'],
            ['season_name' => 'Весна/Осень', 'season_alias' => 'vesnaosen']
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
        DB::table('products')->insert([
            // Верхняя одежада Зима комбинезоны мальчики и девочки
            ['product_title' => 'Комбинезон мальчики ЗИМА Lappinalle',
            'product_price' => '99959',
            'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
            'product_img' => '../img/item.png',
            'product_amount' => 1,
            'sex_id' => 1,
            'categories_id' => 3,
            'season_id' => 1,
             'departments_id' => 1,
             'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
              'product_sale' => null
            ],
            ['product_title' => 'Комбинезон девочки ЗИМА Lappinalle',
                'product_price' => '9959',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png, ../img/pic4.png, ../img/pic3.png, ../img/pic2.png, ../img/pic3.png, ../img/pic4.png, ../img/pic2.png',
                'product_amount' => 11,
                'sex_id' => 2,
                'categories_id' => 3,
                'season_id' => 1,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 20
            ],
            ['product_title' => 'Куртки, парки мальчики ЗИМА Lappinalle',
                'product_price' => '9959',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 54,
                'sex_id' => 1,
                'categories_id' => 3,
                'season_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null

            ],
            ['product_title' => 'Куртки, парки девочки ЗИМА Lappinalle',
                'product_price' => '9995',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic1.png',
                'product_amount' => 4,
                'sex_id' => 2,
                'categories_id' => 3,
                'season_id' => 1,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],


            ['product_title' => 'Комбинезон мальчики весна-осень Lappinalle',
                'product_price' => '9299',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/item.png',
                'product_amount' => 1,
                'sex_id' => 1,
                'categories_id' => 3,
                'season_id' => 2,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],
            ['product_title' => 'Комбинезон девочки весна-осень Lappinalle',
                'product_price' => '9129',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic3.png',
                'product_amount' => 11,
                'sex_id' => 2,
                'categories_id' => 3,
                'season_id' => 2,
                'departments_id' => 1,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],
            ['product_title' => 'Куртки, парки мальчики весна-осень Lappinalle',
                'product_price' => '91239',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 54,
                'sex_id' => 1,
                'categories_id' => 3,
                'season_id' => 2,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null

            ],
            ['product_title' => 'Куртки, парки девочки весна-осень Lappinalle',
                'product_price' => '3119',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic1.png',
                'product_amount' => 4,
                'sex_id' => 2,
                'categories_id' => 3,
                'season_id' => 2,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],


            ['product_title' => 'Шапки мальчики зима Lappinalle',
                'product_price' => '9231',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/item.png',
                'product_amount' => 1,
                'sex_id' => 1,
                'categories_id' => 4,
                'season_id' => 1,
                'departments_id' => 7,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 30
            ],
            ['product_title' => 'Шапки девочки зима Lappinalle',
                'product_price' => '99123',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic3.png',
                'product_amount' => 11,
                'sex_id' => 2,
                'categories_id' => 4,
                'season_id' => 1,
                'departments_id' => 7,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],
            ['product_title' => 'Шапки мальчики весна-осень Lappinalle',
                'product_price' => '9231',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/item.png',
                'product_amount' => 1,
                'sex_id' => 1,
                'categories_id' => 4,
                'season_id' => 2,
                'departments_id' => 7,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],
            ['product_title' => 'Шапки девочки весна-осень Lappinalle',
                'product_price' => '99123',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic3.png',
                'product_amount' => 11,
                'sex_id' => 2,
                'categories_id' => 4,
                'season_id' => 2,
                'departments_id' => 7,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 40
            ],
            ['product_title' => 'Шлемы мальчики зима Lappinalle',
                'product_price' => '4542',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 54,
                'sex_id' => 1,
                'categories_id' => 4,
                'season_id' => 1,
                'departments_id' => 8,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],
            ['product_title' => 'Шлемы девочки зима Lappinalle',
                'product_price' => '4354',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 54,
                'sex_id' => 2,
                'categories_id' => 4,
                'season_id' => 1,
                'departments_id' => 8,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],
            ['product_title' => 'Шлемы мальчики весна-осень Lappinalle',
                'product_price' => '4542',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 54,
                'sex_id' => 1,
                'categories_id' => 4,
                'season_id' => 2,
                'departments_id' => 8,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],
            ['product_title' => 'Шлемы девочки весна-осень Lappinalle',
                'product_price' => '4354',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 54,
                'sex_id' => 2,
                'categories_id' => 4,
                'season_id' => 2,
                'departments_id' => 8,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 20
            ],

            ['product_title' => 'Термобелье мальчики Lappinalle',
                'product_price' => '4542',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 54,
                'sex_id' => 1,
                'categories_id' => 5,
                'season_id' => null,
                'departments_id' => 3,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => 10
            ],
            ['product_title' => 'Термобелье девочки Lappinalle',
                'product_price' => '4354',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 54,
                'sex_id' => 2,
                'categories_id' => 5,
                'season_id' => null,
                'departments_id' => 3,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],
            ['product_title' => 'Флис мальчики Lappinalle',
                'product_price' => '4542',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 54,
                'sex_id' => 1,
                'categories_id' => 5,
                'season_id' => null,
                'departments_id' => 4,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],
            ['product_title' => 'Флис девочки Lappinalle',
                'product_price' => '4354',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 54,
                'sex_id' => 2,
                'categories_id' => 5,
                'season_id' => null,
                'departments_id' => 4,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],

            ['product_title' => 'Куртик, парки мальчики Lappinalle',
                'product_price' => '1222',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 34,
                'sex_id' => 1,
                'categories_id' => 6,
                'season_id' => null,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],
            ['product_title' => 'Куртик, парки девочки Lappinalle',
                'product_price' => '1114',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 14,
                'sex_id' => 2,
                'categories_id' => 6,
                'season_id' => null,
                'departments_id' => 2,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],
            ['product_title' => 'Краги мальчики Lappinalle',
                'product_price' => '1222',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 34,
                'sex_id' => 1,
                'categories_id' => 6,
                'season_id' => null,
                'departments_id' => 5,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],
            ['product_title' => 'Краги девочки Lappinalle',
                'product_price' => '1114',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 14,
                'sex_id' => 2,
                'categories_id' => 6,
                'season_id' => null,
                'departments_id' => 5,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],
            ['product_title' => 'Резиновые сапоги мальчики Lappinalle',
                'product_price' => '1222',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 34,
                'sex_id' => 1,
                'categories_id' => 6,
                'season_id' => null,
                'departments_id' => 6,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],
            ['product_title' => 'Резиновые сапоги девочки Lappinalle',
                'product_price' => '1114',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 14,
                'sex_id' => 2,
                'categories_id' => 6,
                'season_id' => null,
                'departments_id' => 6,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],

            ['product_title' => 'Cапоги мальчики Lappinalle',
                'product_price' => '1222',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 34,
                'sex_id' => 1,
                'categories_id' => 7,
                'season_id' => null,
                'departments_id' => 9,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],
            ['product_title' => 'Кеды сапоги девочки Lappinalle',
                'product_price' => '1114',
                'product_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc consequat dui tortor, at consequat lacus elementum eu. Nulla luctus lorem dui, semper ullamcorper ante rhoncus ornare. Morbi elit dui, aliquet suscipit facilisis pellentesque, pellentesque ut arcu. Suspendisse commodo lobortis sapien eu convallis. Quisque vehicula lectus eu felis tempus, et tristique dolor dapibus. In gravida efficitur enim, ut venenatis elit posuere vitae. Morbi a faucibus odio, in vulputate elit. Maecenas aliquam, ligula ac mollis rhoncus, turpis augue egestas nibh, sed efficitur libero sapien a justo. Nullam sed eros magna.',
                'product_img' => '../img/pic2.png',
                'product_amount' => 14,
                'sex_id' => 2,
                'categories_id' => 7,
                'season_id' => null,
                'departments_id' => 10,
                'added_on' => Carbon::now()->format('Y-m-d H:i:s'),
                'product_sale' => null
            ],

        ]);
        DB::table('users')->insert([
            [
                'users_name' => 'Налимка',
                'users_surname' => 'Налимов',
                'users_email' => 'nalimov@gmail.com',
                'users_password' => '123456',
            ],
            [
                'users_name' => 'Ольга FASPRO',
                'users_surname' => 'FASPRO',
                'users_email' => 'danjablooo1@gmail.com',
                'users_password' => '349324212AP',
            ],
            [
                'users_name' => 'Даня',
                'users_surname' => 'Васильев',
                'users_email' => 'danjablooo11@gmail.com',
                'users_password' => '349324212AP',
            ]
        ]);
        DB::table('reviews')->insert([
            [
                'reviews_text' => 'Я феновый наркоман и что дальше?',
                'reviews_created' => Carbon::now()->format('Y-m-d H:i:s'),
                'users_id' => 1,
                'product_id' => 2,
                'reviews_star' => 4,
                'reviews_available' => 1
            ],
            [
                'reviews_text' => 'Он долбаеб. Илья, где наша страничка вообще?',
                'reviews_created' => Carbon::now()->format('Y-m-d H:i:s'),
                'users_id' => 2,
                'product_id' => 2,
                'reviews_star' => 5,
                'reviews_available' => 1
            ],
            [
                'reviews_text' => 'Мдаа...',
                'reviews_created' => Carbon::now()->format('Y-m-d H:i:s'),
                'users_id' => 3,
                'product_id' => 2,
                'reviews_star' => 1,
                'reviews_available' => 1
            ],
            [
                'reviews_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam blanditiis dignissimos officia similique suscipit! Culpa eius enim fuga incidunt inventore ipsam ipsum iste sint ut? Quaerat sequi suscipit totam voluptate?',
                'reviews_created' => Carbon::now()->format('Y-m-d H:i:s'),
                'users_id' => 3,
                'product_id' => 2,
                'reviews_star' => 5,
                'reviews_available' => 1
            ]
        ]);
    }
}
