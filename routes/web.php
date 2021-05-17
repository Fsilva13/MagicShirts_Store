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
    return view('welcome');    //Retorna a pag. inicial do site.
});

<<<<<<< Updated upstream
//Route::get('Categorias', 'CategoriasController@index') ->Name('Categorias.index'); 
Route::get('Encomenda', 'EncomendasController@index') ->Name('Encomenda');

Auth::routes();
=======
Route::get('clientes','ClientesController@index')->name('cliente');
>>>>>>> Stashed changes

//Route::get('Categorias', 'CategoriasController@index') ->Name('Categorias.index'); 


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

