<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('user', function (Request $request) {
//     return $request->user();
//});


//Аутентификация
Route::post('/login', 'LappiUserController@Log');

Route::post('/register', 'LappiUserController@Reg');

//Личный кабинет
Route::post('/lkind', 'LKController@index');

Route::post('/lkupd', 'LKController@update');

//Варианты доставки
Route::post('/deladmin', 'DelController@admin');

Route::get('/delsite', 'DelController@site');



// АДМИН
// Получаем все товары для страницы продукты
Route::get('/adminallproducts', 'AdminGetAllProductsController@index');

// Добавляем новый товар и обновляем
Route::post('/addprod', 'AddNewProdController@add');

Route::post('/updprod', 'AddNewProdController@update');

// Получаем все размеры для карточки товара
Route::get('/adminallsizes','AllSizesController@index');

// Email
Route::post('/mailer', 'MailerController@send');

//Вывод заказов в админку
Route::get('/admorders', 'AdmOrdersController@all');

//Карточка заказа в админке
Route::post('/admorder', 'AdmOrdersController@order');

//Смена статуса заказа
Route::post('/ordstatus', 'AdmOrdersController@status');

//Админка карточка пользователя
Route::post('/lkadm', 'LKController@admin');

//Админка все пользователи
Route::get('/adminusers', 'AdminUsersController@index');

// Админка получить один товар
Route::get('/admin-product-{id}', 'AdminGetOneProductController@index');

//Удаление товара
Route::post('/delprod', 'DelProdController@del');

// Удаление размера
Route::post('/removesize', 'AdminDeleteSizeController@remove');

// SITE
// Оформление заказа
Route::post('/order', 'CheckoutOrderController@index');

// Самый охуевший в мире фильтр + выдача каталога
Route::get('/filter/{sexalias}/{catalias}/{depalias}/{sortmode}/{sale}/{min}/{max}/{sizes}', 'InfernalFilterFromNalimkaAkaTatarinBitchController@universal');

// Получаем все размеры для sidebar
Route::get('/allsizesforsidebar', 'AllSizeForSideBarController@index');

// Получаем товары в избранное
Route::get('/bookmark/{ids}', 'BookmarkProductsController@index');

// Проверить пароль в кабинете
Route::post('/checkpass', 'LKController@CheckPass');

// Получаем базовые данные для приложения типа категори и т.д
Route::get('/menu', 'BasicDataController@index');

// Получем данные по определенному товару
Route::get('/item-{number}', 'GetDataItemController@index');

// Получем данные для корзины
Route::get('/itemscard/{ids}', 'GetItemsForCartController@index');

// Получем отзывы по товару
Route::get('/itemsreview-{itemNumber}', 'GetItemReviewsController@index');

// Все отзывы
Route::get('/allrev', 'OtzovController@allrev');

// Отправка нового отзыва
Route::post('/newreview', 'OtzovController@newreview');

// Модерация отзыва
Route::post('/modreview', 'OtzovController@moder');

// Карточка отзыва
Route::get('/revcard-{id}', 'OtzovController@revcard');

// Варианты доставки
Route::post('/deladmin', 'DelController@admin');

Route::get('/delsite', 'DelController@site');

//Вывод на главную страницу
Route::get('/mainpage', 'MainPageController@index');

//Апдейт главной страницы
Route::post('/mainupd', 'MainPageController@update');

// Получаем последний заказ
Route::get('/getLastIdOrder', 'GetLastIdOrderController@index');

Route::post('/payment', 'SberController@sber');

// УДАЛЕНИЕ

//// Получаем данные для каталога по гнедеру
//Route::get('/{genders}', 'GenderController@index');
//
//// Получаем данные для каталога по категории
//Route::get('/{genders}/{categories}', 'CategoriesController@index');
//
//// Получаем данные для каталога по категории
//Route::get('/{genders}/{categories}/{departments}', 'DepartmentsController@index');


//// Получаем размеры по товару по гендеру
//Route::get('/sizesIds={numbers}/{genders}', 'SizesGetDataFromGenderController@index');
//
//// Получаем размеры по товару по категории
//Route::get('/sizesIds={numbers}/{genders}/{categories}', 'SizesGetDataFromCategoriesController@index');
//
//// Получаем размеры по товару по подкатегории
//Route::get('/sizesIds={numbers}/{genders}/{categories}/{departments}', 'SizesGetDataFromDepartmentsController@index');

// Получаем товары по скидки по гендеру
//Route::get('/sale/{gender}', 'SaleProductsByGenderController@index');
//
//// Получаем товары по скидки по категории
//Route::get('/sale/{gender}/{categories}', 'SaleProductsByCategoriesController@index');
//
//// Получаем товары по скидки по подкатегории
//Route::get('/sale/{gender}/{categories}/{departments}', 'SaleProductsByDepartmentsController@index');
//
//// Получаем товары по кэшу по гендеру
//Route::get('/cash/{gender}/min-{min}/max-{max}', 'GiveMeCashMinMaxByGenderController@index');
//
//// Получаем товары по кэшу по категории
//Route::get('/cash/{gender}/{categories}/min-{min}/max-{max}', 'GiveMeCashMinMaxByCategoriesController@index');
//
//// Получаем товары по кэшу по подкатегории
//Route::get('/cash/{gender}/{categories}/{departments}/min-{min}/max-{max}', 'GiveMeCashMinMaxByDepartmentsController@index');
//
//// Получаем товары по сортингу по гендеру
//Route::get('/price-{where}/{gender}', 'GetDataFromGenderSortPriceController@index');
//
//// Получаем товары по сортингу по категории
//Route::get('/price-{where}/{gender}/{categories}', 'GetDataFromCategorySortPriceController@index');
//
//// Получаем товары по сортингу по подкатегории
//Route::get('/price-{where}/{gender}/{categories}/{departments}', 'GetDataFromDepartSortPriceController@index');


Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});
