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

Route::group(['middleware' => 'auth'], function () {

    Route::resource('usuarios', 'UserController')
        ->except(['destroy'])
        ->parameters([
            'usuarios' => 'user'
        ]);

    Route::resource('alunos', 'StudentController')
        ->except(['destroy'])
        ->parameters([
            'alunos' => 'user'
        ]);

    Route::resource('disciplinas', 'DisciplineController')
        ->except(['destroy'])
        ->parameters([
            'disciplinas' => 'discipline'
        ]);

    Route::resource('classes', 'ClassroomController')
        ->except(['destroy'])
        ->parameters([
            'classes' => 'classroom'
        ]);

    Route::resource('vincular-disciplinas', 'ClassroomDisciplineUserController')
        ->parameters([
            'vincular-disciplinas' => 'classroom_discipline_user'
        ]);

    Route::resource('matriculas', 'EnrollmentController')
        ->parameters([
            'matriculas' => 'enrollment'
        ]);


});
