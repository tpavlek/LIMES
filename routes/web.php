<?php

Route::get('/', 'HomeController@index');

Route::get('tag/{uuid}', 'TagController@redirectUuid');
Route::get('hello/{id}', 'LocationController@show');
Route::get('hello/{id}/new', 'PostController@create');

Route::post('hello/{id}', 'PostController@store');
