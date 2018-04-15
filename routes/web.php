<?php

Route::get('/', 'HomeController@index');

Route::get('tag/{uuid}', 'TagController@redirectUuid');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('account_connect');

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('register', 'Auth\RegisterController@register')->name('register');

Route::get('hello/{id}', 'LocationController@show')->name('location');

Route::post('hello/{id}', 'PostController@store')->name('post.store');
Route::get('hello/{id}/new', 'PostController@create')->name('post.create');


Route::post('connection/{id}/accept', 'ConnectionController@accept')->name('connection.accept');
Route::delete('connection/{id}', 'ConnectionController@remove')->name('connection.remove');

Route::get('user/{id}/connections', 'ConnectionController@show')->name('connections');
Route::post('user/{id}/connections', 'ConnectionController@add')->name('add_connection');


Route::get('fb-redirect', 'Auth\LoginController@redirectToFacebook')->name('fb-redirect');
Route::get('fb-callback', 'Auth\LoginController@facebookCallback');

Route::get('profile', 'HomeController@profile')->middleware('auth')->name('profile');
Route::post('profile', 'HomeController@save_profile')->middleware('auth')->name('save_profile');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware([ 'auth', 'admin' ])->prefix('admin')->group(function() {
    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::get('location/{id}', 'AdminController@showLocation')->name('admin.show_location');
    Route::put('location/{id}', 'AdminController@updateLocation')->name('admin.update_location');

    Route::get('opendata', 'AdminController@showOpendataImport')->name('admin.opendata_import');
    Route::post('opendata', 'AdminController@fetchOpendata')->name('admin.opendata_fetch');
});



