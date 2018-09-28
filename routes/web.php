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

//These routes will not show to users that are logged in. They will instead get redirected to dashboard.
Route::group(['middleware' => ['dont.show.to.logged.in']], function(){

    Route::post('/user/login',[
        'uses' => 'Auth\LoginController@doLogin'
    ]);

    Route::post('/user/create',[
        'uses' => 'Auth\RegisterController@create'
    ]);

    Route::get('/', function () {
        return view('login');
    });

});

//Only allow logged in users to access these routes.
Route::group(['middleware' => ['loggedin']],function (){

    Route::get('/dashboard',[
        'as' => 'dashboard',
        'uses' => 'DashboardController@index'
    ]);

    Route::get('/profile',[
        'uses' => 'UserController@index'
    ]);

    Route::get('/codes',[
        'uses' => 'QRController@index',
        'as' => 'codes'
    ]);

    Route::get('/category',[
        'uses' => 'CategoryController@index',
        'as' => 'category'
    ]);

    Route::get('/freezer',[
        'uses' => 'FreezerController@index',
        'as' => 'freezer'
    ]);

    Route::get('/items',[
        'uses' => 'ItemController@index',
        'as' => 'items'
    ]);

});


Route::post('/set-active-org',[
    'uses' => 'UserController@setActiveOrg',
]);

Route::get('/user/firstlogin',[
   'as' => 'firstlogin',
   'uses' => 'Auth\LoginController@showFirstLogin'
]);

Route::get('/user/refresh-session',[
    'uses' => 'UserController@refreshUserSession'
]);


Route::get('/organization/{org_id}/scan/{code_uid}',[
    'uses' => 'ScanController@routeScanAction'
]);