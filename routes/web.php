<?php
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('dashboard.welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', function () {
    $authed_user = Auth::user();


  return $authed_user->name . 'you can see your profile';

})->middleware('auth');

