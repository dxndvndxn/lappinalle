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

// Добавляем новый размер
Route::post('/addnewsize','AllSizesController@newsize');

// Удалить новый размер
Route::post('/deletenewsize','AllSizesController@DeleteNewSize');

// Email
Route::post('/mailer', 'MailerController@send');

//Вывод заказов в админку
Route::get('/admorders', 'AdmOrdersController@all');

//Карточка заказа в админке
Route::post('/admorder', 'AdmOrdersController@order');

//Смена статуса заказа
Route::post('/ordstatus', 'AdmOrdersController@status');

//Вернуть товар
Route::post('/returnproduct', 'AdmOrdersController@red');

//Админка карточка пользователя
Route::post('/lkadm', 'LKController@admin');
Route::post('/lkadm', 'LKController@adminIn');

//Админка все пользователи
Route::get('/adminusers', 'AdminUsersController@index');

// Админка получить один товар
Route::get('/admin-product-{id}', 'AdminGetOneProductController@index');

//Удаление товара
Route::post('/delprod', 'DelProdController@del');

// Удаление размера
Route::post('/removesize', 'AdminDeleteSizeController@remove');

//Редактирование категории
Route::post('/updmenu', 'AdmCategController@update');

//Новый пол
Route::post('/newsex', 'AdmCategController@newsex');

//Новая категория
Route::post('/newcat', 'AdmCategController@newcat');

//Новый раздел
Route::post('/newdep', 'AdmCategController@newdep');

// Скачать накладную
Route::post('/loadfile',  'FileController@kek');

Route::get('/getAllIds', 'MainPageController@getAllIds');

// SITE
// Оформление заказа
Route::post('/order', 'CheckoutOrderController@index');

// Самый охуевший в мире фильтр + выдача каталога
Route::get('/filter/{sexalias}/{catalias}/{depalias}/{sortmode}/{sale}/{min}/{max}/{sizes}/{brands}', 'InfernalFilterFromNalimkaAkaTatarinBitchController@universal');

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

// Чекаем кол-во товара на данный конкретный размер
Route::post('/check-amount-catalog_size_id', 'CheckAmountOfProductController@CheckAmount');

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

// Оплата
Route::post('/payment', 'SberController@sber');

// Меняем статус
Route::post('/changestatus', 'ChangeStatusOrderController@index');

// Смена пароля
Route::post('/changepass', 'NewPassController@newpass');

// Поиск
Route::post('/search', 'SearchController@search');

// Поиск в админке
Route::post('/searchadmin', 'SearchController@SearchAdmin');

// Все бренды 
Route::get('/allBrands', 'AllBrandsController@getAllBrands');

// Управление брендами
Route::post('/manageBrands', 'AllBrandsController@manageAllBrands');

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});
