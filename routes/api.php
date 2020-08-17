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

// Получаем базовые данные для приложения типа категори и т.д
Route::get('/menu', 'BasicDataController@index');

// Получем данные по определенному товару через гендер
Route::get('/item-{number}', 'GetItemByGenderController@index');

// Получаем данные для каталога по гнедеру
Route::get('/{genders}', 'GenderController@index');

// Получаем данные для каталога по категории
Route::get('/{genders}/{categories}', 'CategoriesController@index');

// Получаем данные для каталога по категории
Route::get('/{genders}/{categories}/{departments}', 'DepartmentsController@index');

