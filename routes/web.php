<?php

use Illuminate\Support\Facades\Route;
use App\Product;
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
    $products = Product::all();
    return view('welcome', ['products' => $products]);
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');
Route::get('worker/home', 'HomeController@workerHome')->name('worker.home')->middleware('is_worker');


    Route::get('worker/home', 'ProductController@home')->name('worker.home')->middleware('is_worker');
    Route::resource('worker', 'ProductController')->except([
        'index'
    ]);
    Route::get('worker', 'ProductController@index')->name('worker.spostamento');
