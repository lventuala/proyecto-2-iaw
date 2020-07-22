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


    // listar y ABM de materias primas
    Route::get('/mp/index', 'MateriaPrimaController@indexApi');
    Route::put('/mp/update/{id}', 'MateriaPrimaController@updateApi');
    Route::post('/mp/store', 'MateriaPrimaController@storeApi');
    Route::delete('/mp/destroy/{id}', 'MateriaPrimaController@destroyApi');

    // listar y ABM productos
    Route::get('/producto/index', 'ProductoController@indexApi');

    // usuario logueadoy lista de usuarios
    Route::get('/user','UsuarioController@getUsuarioApi');
    Route::get('/usuario/index', 'UsuarioController@indexApi');
    Route::put('/usuario/activar/{id}', 'UsuarioController@activarApi');
    Route::put('/usuario/desactivar/{id}', 'UsuarioController@desactivarApi');
});

Route::post('/login','Auth\LoginController@loginApi');
Route::post('/logout','Auth\LoginController@logoutApi');

Route::get('/productosAll', 'ProductoController@productos')->name('productosAll');

