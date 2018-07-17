<?php

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


//orders
Route::resource('orders','OrdersController'); 


//products
Route::get('products/create','ProductsController@create'); 
Route::post('products','ProductsController@store'); 
Route::get('products/{product}/edit','ProductsController@edit');
Route::put('products/{product}','ProductsController@update');
Route::delete('products/{product}', 'ProductsController@destroy'); 
Route::get('/products/{product}','ProductsController@show');


Route::get('products/{product}/download-barcode','ProductsController@downloadBarcode');