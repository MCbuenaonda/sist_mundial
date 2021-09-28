<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mundial', 'MundialController@index')->name('mundial.index');
Route::get('/mundial/{partido}', 'MundialController@jugar')->name('mundial.jugar');

Route::group([ 'middleware' => ['auth', 'verified'] ], function() {
    Route::get('/confederacion/{confederacion}', 'ConfederacionController@index')->name('confederacion.index');
});

