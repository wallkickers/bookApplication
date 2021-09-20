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

Route::group(['middleware' => 'auth:user', 'namespace' => 'User'], function () {
    // マイページ
    Route::get('users/', 'UserController@show')->name('users.show');

    // 書籍
    Route::get('books', 'BookController@index')->name('books.index');
    Route::get('books/show', 'BookController@show')->name('books.show');
    Route::get('books/search', 'BookController@search')->name('books.search');

    // 書籍貸出し
    Route::resource('application', 'ApplicationController');
});


Route::group(['prefix' => 'admin'], function () {
    Route::get('login',     'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login',    'Admin\LoginController@login');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin', 'namespace' => 'Admin'], function () {
    // ユーザー
    Route::get('/',         'UserController@index')->name('index');
    Route::get('/users/show', 'UserController@show')->name('user.show');
    Route::delete('/users/{user}', 'UserController@destroy')->name('user.destroy');
    Route::get('users/search', 'UserController@search')->name('users.search');

    // 書籍
    Route::get('books', 'BookController@index')->name('books');
    Route::get('books/{book}', 'BookController@show')->name('books.show');
    Route::delete('books/{book}', 'BookController@destroy')->name('books.destroy');

    // 貸し出し履歴
    Route::get('/rental_history', 'BookController@history')->name('rental_history');

    Route::post('logout',   'LoginController@logout')->name('logout');
    Route::get('/form', 'CsvImportController@create')->name('form');
    Route::post('form/import-csv', 'CsvImportController@store')->name('import');
    Route::get('/pdf', 'PdfController@show')->name('book_pdf');
    Route::get('/slack', 'SlackController@index')->name('slack');
    Route::post('/slack/update', 'SlackController@update')->name('slack.update');
});

// 企業登録
Route::group(['prefix' => 'company', 'as' => 'company.', 'namespace' => 'Auth\Company'], function () {
    Route::get('register',     'RegisterCompanyController@showRegisterCompanyForm')->name('register');
    Route::post('register',    'RegisterCompanyController@registerCompany')->name('register');
});
