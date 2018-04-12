<?php

Route::get('/', 'HomeController@index');

Route::get('tag/{uuid}', 'TagController@redirectUuid');
Route::get('hello/{id}', 'LocationController@show')->name('location');

Route::get('hello/{id}/new', 'PostController@create')->name('new_post');
Route::post('hello/{id}', 'PostController@store');

Route::get('user/{id}/connections', 'ConnectionController@show')->name('connections');
Route::post('user/{id}/connections', 'ConnectionController@add')->name('add_connection');

