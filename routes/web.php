<?php

//Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


// Password Reset Routes...
Route::post('password/email', 'Auth\forgotpasswordcontroller@sendresetlinkemail')->name('password.email');
Route::get('password/reset', 'Auth\forgotpasswordcontroller@showlinkrequestform')->name('password.request');
Route::post('password/reset', 'Auth\resetpasswordcontroller@reset')->name('password.update');
Route::get('password/reset/{token}', 'Auth\resetpasswordcontroller@showresetform')->name('password.reset');


//Rotas do painel
Route::group(['prefix' => 'painel', 'namespace' => 'Painel', 'middleware' => 'auth'], function () {
    Route::any('usuarios/pesquisar', 'UserController@search')->name('usuarios.search');
    Route::resource('usuarios', 'UserController');
    Route::get('perfil', 'UserController@showProfile')->name('profile');
    Route::put('perfil/{id}', 'UserController@updateProfile')->name('profile.update');


    Route::any('categories/pesquisar', 'CategoryController@search')->name('categorias.search');
    Route::resource('categorias', 'CategoryController');

    Route::get('/', 'PainelController@index')->name('painel');
});

//Rotas do Site
Route::get('/', 'Site\SiteController@index')->name('home');


