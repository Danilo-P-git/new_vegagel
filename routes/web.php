<?php

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminCartController;
use App\Http\Controllers\CommerceController;

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
//ROTTE PER L'E-COMMERCE
Route::get('/', [CommerceController::class,'showCommerce'])->name('welcome');
Route::get('/filter', [CommerceController::class,'index'])->name('welcome.filter');
Route::get('/filter/{$filtered}', [CommerceController::class,'index'])->name('welcomefiltered');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');
Route::get('worker/home', 'HomeController@workerHome')->name('worker.home')->middleware('is_worker');
Route::get('worker/orders', 'OrderController@index')->name('worker.orders')->middleware('is_worker');
Route::any('worker/orders/{id}', 'OrderController@show')->name('worker.orderShow')->middleware('is_worker');
Route::any('worker/order/confirm/{id}', 'OrderController@confirm')->name('worker.orderConfirm')->middleware('is_worker');
Route::any('worker/order/done/{id}', 'OrderController@done')->name('worker.orderDone')->middleware('is_worker');

Route::post ( 'worker/search', 'ProductController@search' )->name('worker.search')->middleware('is_worker');
// Route::get('worker/{worker}/shipment', 'ProductController@shipment')->name('worker.shipment')->middleware('is_worker');
// Route::put('worker/{worker}','ProductController@shipmentUpdate')->name('worker.test')->middleware('is_worker');
Route::put('worker/test/{id}', 'ProductController@test')->name('worker.test')->middleware('is_worker');
Route::get('worker/home', 'ProductController@home')->name('worker.home')->middleware('is_worker');
Route::resource('worker', 'ProductController')->except([
    'index'
]);

Route::get('worker', 'ProductController@index')->name('worker.spostamento');

Route::get('admin/showUser', 'UserModController@showUser')->name('admin.showUser');
Route::any('admin/editRole/{id}', 'UserModController@editRole')->name('admin.role');
Route::any('admin/editData/{id}', 'UserModController@editData')->name('admin.data');
Route::any('admin/createUser', 'UserModController@createUser')->name('admin.create');
Route::get('admin/orders', 'AdminCartController@index')->name('admin.orders');
Route::get('admin/ordersCreate', 'AdminCartController@displayProducts')->name('admin.ordersCreate');
Route::any('admin/ordersQuantity/{id}', 'AdminCartController@quantitaBloccata')->name('admin.ordersQuantity');
Route::any('admin/ordersNew/{id}', 'AdminCartController@addOrder')->name('admin.addOrder');
Route::any('admin/orderSend','AdminCartController@orderSend')->name('admin.orderSend');
Route::any('admin/orderDelete/{id}', 'AdminCartController@deleteCart')->name('admin.orderDelete');
Route::any('pdf/bolla/{id}', 'OrderController@savePdf')->name('pdf.bolla');
Route::get('admin/categories', 'CategoryController@index')->name('admin.categories');
Route::any('admin/categoriesCreate', 'CategoryController@store')->name('admin.categoriesCreate');
Route::get('admin/products', 'AdminProductController@index')->name('admin.products');
Route::any('pdf/scaduti', 'AdminProductController@stampaScaduti')->name('pdf.scaduti');
Route::any('pdf/inScadenza', 'AdminProductController@stampaInScadenza')->name('pdf.inScadenza');
Route::any('pdf/prodotti', 'AdminProductController@stampaProdotti')->name('pdf.prodotti');

