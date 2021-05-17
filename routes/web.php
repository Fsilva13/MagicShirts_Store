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

Route::get('encomenda/create', 'EncomendasController@create') ->name('encomendas.create');
Route::post('encomenda/store', 'EncomendasController@store') ->name('encomendas.store');
Route::get('clientes','ClientesController@index')->name('cliente');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

