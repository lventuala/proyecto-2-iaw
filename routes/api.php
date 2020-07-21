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
    // recuperar usuario
    Route::get('/user','UsuarioController@getUsuarioApi');

    // listar y ABM de materias primas
    Route::get('/mp/index', 'MateriaPrimaController@indexApi');
    Route::put('/mp/update/{id}', 'MateriaPrimaController@updateApi');
    Route::post('/mp/store', 'MateriaPrimaController@storeApi');
    Route::delete('/mp/destroy/{id}', 'MateriaPrimaController@destroyApi');

});

Route::post('/login','Auth\LoginController@loginApi');
Route::post('/logout','Auth\LoginController@logoutApi');

Route::get('/productosAll', 'ProductoController@productos')->name('productosAll');

