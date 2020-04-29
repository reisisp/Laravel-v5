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
    'middleware' => ['auth', 'is_admin']
], function () {
    /*Admin functions*/
    Route::get('/', 'IndexController@index')->name('index');

    /*CRUD Категорий*/
    Route::resource('/categories', 'CategoriesController')->except('show');

    /*CRUD Новостей*/
    Route::resource('/news', 'NewsController')->except('show');

    /*CRUD Профилей*/
    Route::resource('/profiles', 'ProfileController')->except('show');

    /*Is_admin On/Off*/
    Route::get('/profiles/toggleAdmin/{profile}', 'ProfileController@toggleAdmin')->name('toggleAdmin');

    /*CRUD Resources*/
    Route::resource('/resources', 'ResourcesController')->except('show');

    /* Парсинг новостей*/
    Route::get('/parse', 'ParseController@index')->name('parser');

    /*Выгрузка новостей*/
    Route::get('/json', 'IndexController@json')->name('json');
});

/*
|--------------------------------------------------------------------------
| Пользователь
|--------------------------------------------------------------------------
|
| Профиль пользователя
|
*/
Route::match(['get', 'post'], '/profile', 'Auth\EditProfileController@update')->name('profile.edit');


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

Route::get('/auth/vk', 'LoginController@loginVK')->name('vkLogin');
Route::get('/auth/vk/response', 'LoginController@responseVK')->name('vkResponse');
Auth::routes();



