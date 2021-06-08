<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product', 'api\ProductController@index');
Route::get('product/{id}', 'api\ProductController@show');
Route::post('product', 'api\ProductController@create');
Route::put('product/{id}', 'api\ProductController@update');
Route::delete('product/{id}', 'api\ProductController@destroy');
Route::get('admin/search', 'api\SearchController@aziende')->name('admin.aziendeSearch');
Route::get('admin/searchUtente', 'api\SearchController@utente')->name('admin.utenteSearch');
Route::get('admin/searchProdotto', 'api\SearchController@prodottoSingolo')->name('admin.prodottoCerca');
