<?php

Route::get('/', 'HomeController@index');

Route::get('tag/{uuid}', 'TagController@redirectUuid');
Route::get('hello/{id}', 'LocationController@show')->name('location');
Route::get('hello/{id}/new', 'PostController@create')->name('new_post');

Route::post('hello/{id}', 'PostController@store');
