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

/*
|--------------------------------------------------------------------------
| Новости и категории
|--------------------------------------------------------------------------
|
*/
Route::get('/', 'NewsController@index')
    ->name('news.index');
Route::group([
    'prefix' => 'categories',
], function () {
    Route::get('/', 'CategoriesController@index')
        ->name('categories.index');
    Route::get('/{name}', 'CategoriesController@show')
        ->name('categories.show');
    Route::get('/{name}/{news}', 'NewsController@show')
        ->name('news.show')
        ->where('id', '[0-9]+');
});

/*
|--------------------------------------------------------------------------
| Админка
|--------------------------------------------------------------------------
|
| Функции админа
|
*/
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.'
], function () {
    /*CRUD*/
    Route::get('/', 'IndexController@index')
        ->name('index');
    Route::match(['get', 'post'], '/create', 'NewsController@create')
        ->name('create');
    Route::get('/destroy/{news}', 'NewsController@destroy')
        ->name('destroy');
    Route::get('/edit/{news}', 'NewsController@edit')
        ->name('edit');
    Route::post('/update/{news}', 'NewsController@update')
        ->name('update');

    Route::get('/download', 'IndexController@json')
        ->name('download');
});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
