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

Route::resource('books', 'BookController');

Route::resource('application', 'ApplicationController');

Route::get('/form', function () {
    return view('form');
});

// Route::post('form/import-csv', 'CsvImportController@store');

// Route::get('/logout',[
//     'uses' => 'UserController@getLogout',
//     'as' => 'user.logout'
//     ]);