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
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('product', 'ProductController@index')->name('worker.index');
Route::get('product/show/{id}', 'ProductController@show')->name('worker.show');
Route::get('product/create', 'ProductController@create')->name('worker.create');
Route::post('product', 'ProductController@store')->name('worker.store');
Route::get('product/{id}/edit', 'ProductController@edit')->name('worker.edit');
Route::put('product/{id}', 'ProductController@update')->name('worker.update');
Route::delete('product/destroy{id}', 'ProductController@destroy');
