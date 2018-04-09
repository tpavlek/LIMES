<?php

Route::get('/', 'HomeController@index');

Route::get('tag/{uuid}', 'TagController@redirectUuid');
Route::get('hello/{id}', 'LocationController@show');
