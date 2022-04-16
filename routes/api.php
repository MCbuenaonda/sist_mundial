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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Listado de API
Route::get('/confederaciones', 'ApiController@confederaciones')->name('confederaciones');
Route::get('/confederaciones/{confederacion}', 'ApiController@confederacion')->name('confederacion');

Route::get('/paises/{pais}', 'ApiController@pais')->name('pais');

Route::get('/mundiales/{mundial}', 'ApiController@mundial')->name('mundial');

Route::get('/juegos', 'ApiController@juegos')->name('juegos');
Route::get('/juegos/play', 'ApiController@juego')->name('juego');
Route::get('/juegos/{juego}', 'ApiController@juegoword');
Route::post('/juegos', 'ApiController@store')->name('store');
Route::get('/detalles/{juego}', 'ApiController@grupopais');

Route::post('/compra', 'ApiController@storesell')->name('storesell');
