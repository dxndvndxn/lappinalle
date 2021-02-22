<?php
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\File;
//Auth::routes();

Route::get('/{any}', 'HomeController@index')->where('any', '^(?!api\/)[\/\w\.-]*');
//Route::get('/', function () {
//    return File::get(public_path() . '/kotacty.html');
//});
