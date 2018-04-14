<?php

Route::get('/', 'HomeController@index');

Route::get('tag/{uuid}', 'TagController@redirectUuid');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('account_connect');

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('register', 'Auth\RegisterController@register')->name('register');

Route::get('hello/{id}', 'LocationController@show')->name('location');

Route::post('hello/{id}', 'PostController@store')->name('post.store');
Route::get('hello/{id}/new', 'PostController@create')->name('post.create');


Route::get('user/{id}/connections', 'ConnectionController@show')->name('connections');
Route::post('user/{id}/connections', 'ConnectionController@add')->name('add_connection');
Route::delete('user/{id}/connections', 'ConnectionController@remove')->name('remove_connection');

Route::get('fb-redirect', 'Auth\LoginController@redirectToFacebook')->name('fb-redirect');
Route::get('fb-callback', 'Auth\LoginController@facebookCallback');

Route::get('profile', 'HomeController@profile')->middleware('auth')->name('profile');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

