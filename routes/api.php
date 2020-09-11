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
Route::get('/lkadm', 'LKController@admin');

//Админка все пользователи
Route::get('/adminusers', 'AdminUsersController@index');

Route::get('/admin-product-{id}', 'AdminGetOneProductController@index');


// SITE
// Оформление заказа
Route::post('/order', 'CheckoutOrderController@index');

// Проверить пароль в кабинете
Route::post('/checkpass', 'LKController@CheckPass');

// Получаем базовые данные для приложения типа категори и т.д
Route::get('/menu', 'BasicDataController@index');

// Получем данные по определенному товару через гендер
Route::get('/item-{number}', 'GetDataItemController@index');

// Получем данные для корзины
Route::get('/itemscard/{ids}', 'GetItemsForCartController@index');

// Получаем товары по скидки по гендеру
Route::get('/sale/{gender}', 'SaleProductsByGenderController@index');

// Получаем товары по скидки по категории
Route::get('/sale/{gender}/{categories}', 'SaleProductsByCategoriesController@index');

// Получаем товары по скидки по подкатегории
Route::get('/sale/{gender}/{categories}/{departments}', 'SaleProductsByDepartmentsController@index');

// Получаем товары по кэшу по гендеру
Route::get('/cash/{gender}/min-{min}/max-{max}', 'GiveMeCashMinMaxByGenderController@index');

// Получаем товары по кэшу по категории
Route::get('/cash/{gender}/{categories}/min-{min}/max-{max}', 'GiveMeCashMinMaxByCategoriesController@index');

// Получаем товары по кэшу по подкатегории
Route::get('/cash/{gender}/{categories}/{departments}/min-{min}/max-{max}', 'GiveMeCashMinMaxByDepartmentsController@index');

// Получаем товары по сортингу по гендеру
Route::get('/price-{where}/{gender}', 'GetDataFromGenderSortPriceController@index');

// Получаем товары по сортингу по категории
Route::get('/price-{where}/{gender}/{categories}', 'GetDataFromCategorySortPriceController@index');

// Получаем товары по сортингу по подкатегории
Route::get('/price-{where}/{gender}/{categories}/{departments}', 'GetDataFromDepartSortPriceController@index');

// Получем отзывы по товару
Route::get('/itemsreview-{itemNumber}', 'GetItemReviewsController@index');

// Получаем размеры по товару по гендеру
Route::get('/sizesIds={numbers}/{genders}', 'SizesGetDataFromGenderController@index');

// Получаем размеры по товару по категории
Route::get('/sizesIds={numbers}/{genders}/{categories}', 'SizesGetDataFromCategoriesController@index');

// Получаем размеры по товару по подкатегории
Route::get('/sizesIds={numbers}/{genders}/{categories}/{departments}', 'SizesGetDataFromDepartmentsController@index');

// Получаем данные для каталога по гнедеру
Route::get('/{genders}', 'GenderController@index');

// Получаем данные для каталога по категории
Route::get('/{genders}/{categories}', 'CategoriesController@index');

// Получаем данные для каталога по категории
Route::get('/{genders}/{categories}/{departments}', 'DepartmentsController@index');


Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});
