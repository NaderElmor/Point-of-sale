<?php

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function (){

        Route::get('/welcome', 'WelcomeController@index')->name('welcome');
        Route::get('/', 'WelcomeController@index')->name('index');

        //users routes
        Route::resource('/users', 'UserController');


        //categories routes
        Route::resource('/categories', 'CategoryController');


        //products routes
        Route::resource('/products', 'ProductController');

        //clients routes
        Route::resource('/clients', 'ClientController');


         //orders' clients routes
        Route::resource('clients.orders', 'Client\OrderController');



    });// end of dashboard routes

});//end of localization  routes



