<?php

use App\Http\Controllers\EstampasController;
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


Route::get('encomenda/create','EncomendasController@create')->name('encomenda.create');
Route::post('encomenda/store','EncomendasController@store')->name('encomenda.store');
Route::get('cliente/create','ClientesController@create')->name('cliente.create');
Route::post('cliente/store','ClientesController@store')->name('cliente.store');
Route::get('estampa/create','EstampasController@create')->name('estampa.create');
Route::post('estampa/store','EstampasController@store')->name('estampa.store');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

