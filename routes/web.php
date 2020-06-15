<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/usuarios', 'UsuarioController@index')->name('usuarios');
Route::get('/productos', 'ProductoController@index')->name('productos');

//Route::get('/materias-primas', 'MateriaPrimaController@index')->name('materias-primas');
//Route::post('/materias-primas/store', 'MateriaPrimaController@store')->name('materias-primas.store');
Route::resource('materias-primas', 'MateriaPrimaController');


Route::get('/', function () {
    return view('welcome');
});

Route::view('URI', 'viewName');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
