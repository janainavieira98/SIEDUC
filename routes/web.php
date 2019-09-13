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

use App\Mail\WelcomeEmail;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::group(['namespace' => 'Auth'], function() {
   Route::get('/login', 'LoginController@showLoginForm')->name('login');
   Route::post('/login', 'LoginController@login');
   Route::post('/logout', 'LoginController@logout')->name('logout');
   Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
   Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
   Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
   Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user', 'UserController@index')->name('user.form')->middleware('can:create,App\User');
Route::post('/user', 'UserController@store');
