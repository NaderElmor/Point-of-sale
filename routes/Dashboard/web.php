<?php

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function (){

        Route::get('/', 'WelcomeController@index')->name('welcome');
        Route::get('index', 'DashboardController@index')->name('index');

        //user routes
        Route::resource('/users', 'UserController');



    });// end of dashboard routes

});//end of localization  routes



