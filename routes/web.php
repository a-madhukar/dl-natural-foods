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
Route::get('orders/create', 'OrdersController@create'); 
Route::post('orders','OrdersController@store'); 



//products
Route::post('products','ProductsController@store'); 

Route::get('products/{product}/generate-barcode','ProductsController@generateBarcode');