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

    // Routes Users...
    Route::any('users/search', 'UserController@search')->name('users.search');
    Route::any('users/{id}/profile/search', 'UserController@searchProfiles')->name('users.profiles.search');


    Route::get('users/{id}/profile', 'UserController@profiles')->name('users.profiles');
    Route::get('users/{id}/profile/{profileId}/delete', 'UserController@userDeleteProfile')->name('users.profile.delete');
    Route::get('users/{id}/profile/cadastrar', 'UserController@listProfileAdd')->name('users.profiles.list');
    Route::post('users/{id}/profile/cadastrar', 'UserController@userAddProfile')->name('users.profiles.add');
    Route::resource('users', 'UserController');

    Route::get('profile', 'UserController@showProfile')->name('profile');
    Route::put('profile/{id}', 'UserController@updateProfile')->name('profile.update');


    // Routes Profiles...
    Route::any('profiles/{id}/usuario/pesquisar', 'ProfileController@searchUsers')->name('profiles.users.search');
    Route::any('profiles/{id}/permissoes/pesquisar', 'ProfileController@searchPermissions')->name('profiles.permissions.search');
    Route::any('profiles/pesquisar', 'ProfileController@search')->name('profiles.search');


    Route::get('profiles/{id}/usuario', 'ProfileController@users')->name('profiles.users');
    Route::get('profiles/{id}/usuario/cadastrar', 'ProfileController@listUsersAdd')->name('profiles.users.list');
    Route::post('profiles/{id}/usuario/cadastrar', 'ProfileController@userAddProfile')->name('profiles.users.add');
    Route::get('profiles/{id}/usuario/{userId}/delete', 'ProfileController@userDeleteProfile')->name('profiles.users.delete');

    Route::get('profiles/{id}/permissao', 'ProfileController@permissions')->name('profiles.permissions');
    Route::get('profiles/{id}/permissao/cadastrar', 'ProfileController@listPermissionAdd')->name('profiles.permissions.list');
    Route::post('profiles/{id}/permissao/cadastrar', 'ProfileController@permissionAddProfile')->name('profiles.permissions.add');
    Route::get('profiles/{id}/permissao/{permissionId}/delete', 'ProfileController@permissionDeleteProfile')->name('profiles.permissions.delete');



    Route::resource('profiles', 'ProfileController');


    // Routes Permissions...
    Route::any('permissions/{id}/profile/search', 'PermissionController@searchProfiles')->name('permissions.profiles.search');
    Route::any('permissions/search', 'PermissionController@search')->name('permissions.search');

    Route::get('permissions/{id}/profile/cadastrar', 'PermissionController@listProfileAdd')->name('permissions.profiles.list');
    Route::get('permissions/{id}/perfil', 'PermissionController@profiles')->name('permissions.profiles');
    Route::get('permissions/{id}/profile/{profileId}/delete', 'PermissionController@permissionDeleteProfile')->name('permissions.profile.delete');
    Route::post('permissions/{id}/profile/cadastrar', 'PermissionController@permissionAddProfile')->name('permissions.profile.add');
    Route::resource('permissions', 'PermissionController');

    // Routes Categories...
    Route::any('categories/pesquisar', 'CategoryController@search')->name('categorias.search');
    Route::resource('categorias', 'CategoryController');


    Route::any('posts/pesquisar', 'PostController@search')->name('posts.search');
    Route::resource('posts', 'PostController');


    // Routes Comments...
    Route::any('comentarios/pesquisar', 'CommentController@search')->name('comentarios.search');
    Route::get('comentarios/{id}/resposta', 'CommentController@answers')->name('comentarios.answers');
    Route::post('comentarios/{id}/answer', 'CommentController@answersComment')->name('answerComment');
    Route::get('comentarios/{idComentario}/answer/{idResposta}', 'CommentController@destroyAnswer')->name('answer.destroy');
    Route::resource('comentarios', 'CommentController');



    Route::get('/', 'PainelController@index')->name('painel');
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



