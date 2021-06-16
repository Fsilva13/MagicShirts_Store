<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//Pag.Inicial
Route::get('/','TshirtsController@index')->name('tshirt.list');

//Encomenda
Route::get('encomenda/list','EncomendasController@index')->name('encomenda.list');
Route::get('encomenda/create','EncomendasController@create')->name('encomenda.create');
Route::post('encomenda/store','EncomendasController@store')->name('encomenda.store');
Route::delete('encomenda/destroy/{id}','EncomendasController@destroy')->name('encomenda.destroy');
Route::get('encomenda/edit/{id}','EncomendasController@edit')->name('encomenda.edit');
Route::put('encomenda/update/{id}','EncomendasController@update')->name('encomenda.update');

//Cliente
Route::get('cliente/list','ClientesController@index')->name('cliente.list');
Route::get('cliente/create','ClientesController@create')->name('cliente.create');
Route::post('cliente/store','ClientesController@store')->name('cliente.store');
Route::delete('cliente/destroy/{id}','ClientesController@destroy')->name('cliente.destroy');
Route::get('cliente/edit/{id}','ClientesController@edit')->name('cliente.edit');
Route::put('cliente/update/{id}','ClientesController@update')->name('cliente.update');

//Estampa
Route::get('estampa/create','EstampasController@create')->name('estampa.create');
Route::post('estampa/store','EstampasController@store')->name('estampa.store');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');