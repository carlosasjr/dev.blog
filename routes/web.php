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


    Route::any('posts/pesquisar', 'PostController@search')->name('posts.search');
    Route::resource('posts', 'PostController');

    Route::get('/', 'PainelController@index')->name('painel');

    Route::any('comentarios/pesquisar', 'CommentController@search')->name('comentarios.search');
    Route::get('comentarios/{id}/resposta', 'CommentController@answers')->name('comentarios.answers');
    Route::post('comentarios/{id}/answer', 'CommentController@answersComment')->name('answerComment');

    Route::get('comentarios/{idComentario}/answer/{idResposta}', 'CommentController@destroyAnswer')->name('answer.destroy');

    Route::resource('comentarios', 'CommentController');
});

//Rotas do Site
Route::group(['namespace' => 'Site'], function () {
    Route::get('/tutorial/{url}', 'SiteController@post')->name('post');
    Route::get('/categoria/{url}', 'SiteController@category');
    Route::get('/empresa', 'SiteController@company');
    Route::get('/contato', 'SiteController@contact');
    Route::post('/contact', 'SiteController@sendContact')->name('contact');
    Route::post('/comment-post', 'SiteController@commentPost')->name('comment');
    Route::any('/pesquisar', 'SiteController@search')->name('search.blog');


    Route::get('/', 'SiteController@index')->name('home');
});



