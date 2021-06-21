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
Route::get('/','EstampasController@index')->name('estampas.list');

//Encomenda
Route::get('encomenda/list','EncomendasController@index')->name('encomenda.list');
Route::get('encomenda/create','EncomendasController@create')->name('encomenda.create');
Route::post('encomenda/store','EncomendasController@store')->name('encomenda.store');
Route::patch('encomenda/update/{encomenda}','EncomendasController@update')->name('encomenda.update');

//Utilizador
Route::get('utilizador/list','UtilizadoresController@index')->name('utilizador.list');
Route::delete('utilizador/{user}','UtilizadoresController@destroy')->name('utilizador.destroy');
Route::get('utilizador/edit/{id}','UtilizadoresController@edit')->name('utilizador.edit');
Route::put('utilizador/update/{id}','UtilizadoresController@update')->name('utilizador.update');
Route::put('utilizador/password','UtilizadoresController@password')->name('utilizador.password');
Route::patch('utilizador/bloquear/{user}','UtilizadoresController@bloquear')->name('utilizador.bloquear');
Route::get('utilizador/create','UtilizadoresController@create')->name('utilizador.create');
Route::post('utilizador/store','UtilizadoresController@store')->name('utilizador.store');

//Estampa
Route::get('estampa/create','EstampasController@create')->name('estampa.create');
Route::post('estampa/store','EstampasController@store')->name('estampa.store');
Route::get('estampa/edit/{estampa}','EstampasController@edit')->name('estampa.edit');
Route::delete('estampa/{estampa}','EstampasController@destroy')->name('estampa.destroy');
Route::put('estampa/update/{estampa}','EstampasController@update')->name('estampa.update');

//Estampas_Privadas
Route::get('estampa/privadas','EstampasController@privadas')->name('estampas.privadas');
Route::get('estampa/privadas/{estampa}','EstampasController@imagem')->name('estampas.privadas.imagem');

//Carrinho
Route::get('carrinho/cart','CarrinhoController@index')->name('carrinho.index');
Route::post('carrinho/cart','CarrinhoController@store')->name('carrinho.store');
Route::delete('carrinho/cart/{id}','CarrinhoController@destroy')->name('carrinho.destroy');

//PDF
Route::get('encomenda/pdf/{encomenda}','EncomendasController@pdf')->name('encomenda.pdf');

//Cores
Route::get('cor/list','CoresController@index')->name('cor.list');
Route::get('cor/edit/{id}','CoresController@edit')->name('cor.edit');
Route::put('cor/update/{id}','CoresController@update')->name('cor.update');
Route::delete('cor/{id}','CoresController@destroy')->name('cor.destroy');

//Preco
Route::get('preco/list','PrecosController@index')->name('preco.list');
Route::get('preco/edit/{id}','PrecosController@edit')->name('preco.edit');
Route::put('preco/update/{id}','PrecosController@update')->name('preco.update');

Auth::routes(['verify' => true]);
