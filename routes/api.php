<?php

use Illuminate\Http\Request;

Route::prefix('user')->group(function() {
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');
});

Route::prefix('post')->group(function() {
    Route::group(['middleware' => 'auth:api','CheckIsAdmin'], function() {
        Route::post('/', 'PostController@store');
        Route::put('/', 'PostController@update');
        Route::delete('/{id}', 'PostController@destroy');
    });
});

Route::get('posts', 'PostController@index')->middleware('auth:api');