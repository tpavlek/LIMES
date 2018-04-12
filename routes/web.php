<?php

Route::get('/', 'HomeController@index');

Route::get('tag/{uuid}', 'TagController@redirectUuid');

Route::get('login', 'HomeController@login')->name('account_connect');

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('register', 'Auth\RegisterController@register')->name('register');

Route::get('hello/{id}', 'LocationController@show')->name('location');
Route::get('hello/{id}/new', 'PostController@create')->name('new_post');

Route::post('hello/{id}', 'PostController@store');
