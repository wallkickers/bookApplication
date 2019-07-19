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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::resource('sample', 'Controller', ['only' => ['index']]);

// Route::resource('test', 'TestController');

// Route::apiResource('api/posts', 'PostController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth:user'], function(){
    Route::resource('books', 'BookController');
    Route::resource('application', 'ApplicationController');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('/',         function () { return redirect('/admin/home'); });
    Route::get('login',     'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login',    'Admin\LoginController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::post('logout',   'Admin\LoginController@logout')->name('admin.logout');
    Route::get('home',      'Admin\HomeController@index')->name('admin.home');

    Route::get('/form', function () { return view('form'); });
    Route::post('form/import-csv', 'CsvImportController@store');
});

// Route::get('/logout',[
//     'uses' => 'UserController@getLogout',
//     'as' => 'user.logout'
//     ]);
