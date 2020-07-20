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

Route::group(['middleware' => 'auth:api'], function() {
    /*Route::get('/user', function (Request $request) {
        return $request->user();
    });*/

    Route::get('/user','UsuarioController@getUsuarioApi');

    Route::get('/mp', 'MateriaPrimaController@indexApi');

    Route::put('/updateMP/{id}', 'MateriaPrimaController@updateApi');



});

Route::post('/login','Auth\LoginController@loginApi');
Route::post('/logout','Auth\LoginController@logoutApi');

Route::get('/productosAll', 'ProductoController@productos')->name('productosAll');

