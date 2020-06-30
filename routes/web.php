<?php

use App\Producto;
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

// visible para usuarios registrados
Route::get('/usuarios', 'UsuarioController@index')->name('usuarios')->middleware('auth');
Route::put('/usuarios/activar/{id}', 'UsuarioController@activar')->name('usuarios.activar')->middleware('auth');
Route::put('/usuarios/desactivar/{id}', 'UsuarioController@desactivar')->name('usuarios.desactivar')->middleware('auth');

Route::resource('materias-primas', 'MateriaPrimaController')->middleware('auth');
Route::resource('productos', 'ProductoController')->middleware('auth');
Route::resource('pedidos', 'PedidoController')->middleware('auth');

Route::get('/productosPedidos', 'ProductoController@productosPedidos')->name('productosPedidos')->middleware('auth');

// visible para todos
Route::get('/productosAll', 'ProductoController@productosWeb')->name('productosAll');

Route::get('/', 'InicioController@inicio');

/*
Route::get('/', function () {
    return view('inicio');
});
*/

Route::view('URI', 'viewName');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
