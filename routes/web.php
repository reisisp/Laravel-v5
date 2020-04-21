<?php

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
    'as' => 'admin.',
    'middleware' =>'auth'
], function () {
    Route::match(['get', 'post'], '/profile','ProfileController@update')->name('profile.update');

    /*CRUD Новостей*/
    Route::resource('/news', 'NewsController');

    /*CRUD Категорий*/
    Route::resource('/categories', 'CategoriesController');

    /*Выгрузка новостей*/
    Route::get('/json', 'IndexController@json')->name('json');



   /* Route::get('/categories', 'CategoryController@index')->name('category.index');
    Route::match(['get', 'post'],'/categories/create', 'CategoryController@create')->name('category.create');
    Route::get('/categories/destroy/{categories}', 'CategoryController@destroy')->name('category.destroy');
    Route::get('/categories/edit/{categories}', 'CategoryController@edit')->name('category.edit');
    Route::post('/categories/update/{categories}', 'CategoryController@update')->name('category.update');*/


});
/*Добавление пользователя*/
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

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
/*Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');*/



