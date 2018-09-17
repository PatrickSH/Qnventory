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
    return view('login');
});

Route::get('/user/firstlogin',[
   'as' => 'firstlogin',
   'uses' => 'Auth\LoginController@showFirstLogin'
]);

Route::get('/dashboard',[
    'as' => 'dashboard',
    'uses' => 'DashboardController@index'
]);

Route::post('/user/login',[
   'uses' => 'Auth\LoginController@doLogin'
]);

Route::post('/user/create',[
    'uses' => 'Auth\RegisterController@create'
]);
