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
    /*CRUD Новостей*/
    Route::get('/', 'IndexController@index')->name('index');
    Route::match(['get', 'post'], '/create', 'NewsController@create')->name('create');
    Route::get('/destroy/{news}', 'NewsController@destroy')->name('destroy');
    Route::get('/edit/{news}', 'NewsController@edit')->name('edit');
    Route::post('/update/{news}', 'NewsController@update')->name('update');

    Route::get('/json', 'IndexController@json')->name('json');

    /*CRUD Категорий*/

    Route::get('/categories', 'CategoryController@index')->name('category.index');
    Route::match(['get', 'post'],'/categories/create', 'CategoryController@create')->name('category.create');
    Route::get('/categories/destroy/{categories}', 'CategoryController@destroy')->name('category.destroy');
    Route::get('/categories/edit/{categories}', 'CategoryController@edit')->name('category.edit');
    Route::post('/categories/update/{categories}', 'CategoryController@update')->name('category.update');
});


/*
|--------------------------------------------------------------------------
| Новости и категории
|--------------------------------------------------------------------------
|
*/
Route::get('/', 'NewsController@index')->name('news.index');
Route::get('/one/{news}', 'NewsController@show')->name('news.show')
    ->where('id', '[0-9]+');
Route::group([
    'as' => 'categories.'
], function () {
    Route::get('/categories', 'CategoriesController@index')
        ->name('index');
    Route::get('/category/{name}', 'CategoriesController@show')
        ->name('show');
});


Auth::routes();


