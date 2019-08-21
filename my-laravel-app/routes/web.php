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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth:user'], function(){
    Route::resource('users', 'UserController');
    Route::resource('books', 'BookController');
    Route::post('books/search', 'BookController@search')->name('books.search');
    Route::resource('application', 'ApplicationController');
});


Route::group(['prefix' => 'admin'], function() {
    Route::get('/',         'Admin\UserController@index')->name('admin.index');
    Route::get('login',     'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login',    'Admin\LoginController@login');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin', 'namespace' => 'Admin'], function() {
    Route::post('logout',   'LoginController@logout')->name('logout');
    Route::get('home',      'HomeController@index')->name('home');

    Route::get('/form', 'CsvImportController@create')->name('form');
    Route::post('form/import-csv', 'CsvImportController@store')->name('import');

    Route::resource('books', 'BookController');
});

