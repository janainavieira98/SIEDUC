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

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout')->name('logout');
    Route::post('/senha/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/senha/resetar', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
    Route::get('/senha/resetar/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('usuarios', 'UserController')
    ->except(['destroy'])
    ->parameters([
        'usuarios' => 'user'
    ]);
