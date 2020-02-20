<?php
use Illuminate\Support\Facades\Auth;

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
    return view('dashboard.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', function () {
    $authed_user = Auth::user();


  return $authed_user->name . 'you can see your profile';

})->middleware('auth');

