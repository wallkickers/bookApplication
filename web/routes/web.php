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

Route::group(['middleware' => 'auth:user'], function () {
    Route::resource('users', 'UserController');
    Route::get('books', 'BookController@index')->name('books.index');
    Route::get('books/show', 'BookController@show')->name('books.show');
    Route::get('books/search', 'BookController@search')->name('books.search');
    Route::resource('application', 'ApplicationController');
});


Route::group(['prefix' => 'admin'], function () {
    Route::get('/',         'Admin\UserController@index')->name('admin.index');
    Route::get('/users/show', 'Admin\UserController@show')->name('admin.user.show');
    Route::delete('/users/{user}', 'Admin\UserController@destroy')->name('admin.user.destroy');
    Route::get('users/search', 'Admin\UserController@search')->name('users.search');
    Route::get('login',     'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login',    'Admin\LoginController@login');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin', 'namespace' => 'Admin'], function () {
    Route::post('logout',   'LoginController@logout')->name('logout');
    Route::get('/form', 'CsvImportController@create')->name('form');
    Route::post('form/import-csv', 'CsvImportController@store')->name('import');
    Route::get('/pdf', 'PdfController@show')->name('book_pdf');
    Route::get('/slack', 'SlackController@index')->name('slack');
    Route::post('/slack/update', 'SlackController@update')->name('slack.update');
    Route::resource('books', 'BookController');

    // 貸し出し履歴
    Route::get('/rental_history', 'BookController@history')->name('rental_history');
});

// 企業登録
Route::group(['prefix' => 'company', 'as' => 'company.', 'namespace' => 'Auth\Company'], function () {
    Route::get('register',     'RegisterCompanyController@showRegisterCompanyForm')->name('register');
    Route::post('register',    'RegisterCompanyController@registerCompany')->name('register');
});
