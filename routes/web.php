<?php

Route::get('/', function () {
    return redirect('home');
});

//auth 
Auth::routes();
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('account/activate','AccountController@activateUserAccount'); 

Route::group(['middleware' => 'auth'], function(){

    Route::get('account/send-activation-email', 'AccountController@show'); 
    Route::post('account/send-activation-email', 'AccountController@sendActivationEmail'); 
    
    Route::get('/home', 'HomeController@index')->name('home')->middleware('activeUser');
    
    //orders
    Route::resource('orders','OrdersController')->middleware('activeUser'); 

    //products
    Route::resource('products','ProductsController'); 
    

    Route::get('products/{product}/download-barcode','ProductsController@downloadBarcode');
}); 

