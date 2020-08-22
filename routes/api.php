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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {

        // Below mention routes are public, user can access those without any restriction.
        // Create New User
        Route::post('register', 'AuthController@register');

        // Login User
        Route::post('login', 'AuthController@login');

        // Refresh the JWT Token
        Route::get('refresh', 'AuthController@refresh');

        // Below mention routes are available only for the authenticated users.
        Route::middleware('auth:api')->group(function () {
            // Get user info
            Route::get('user', 'AuthController@user');

            // Logout user from application
            Route::post('logout', 'AuthController@logout');
        });
    });
});
// Получаем базовые данные для приложения типа категори и т.д
Route::get('/menu', 'BasicDataController@index');

// Получем данные по определенному товару через гендер
Route::get('/item-{number}', 'GetDataItemController@index');

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

// Получаем данные для каталога по гнедеру
Route::get('/{genders}', 'GenderController@index');

// Получаем данные для каталога по категории
Route::get('/{genders}/{categories}', 'CategoriesController@index');

// Получаем данные для каталога по категории
Route::get('/{genders}/{categories}/{departments}', 'DepartmentsController@index');


