<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'namespace' => 'Api'], function () {

    Route::post('register',     'AuthController@register');
    Route::post('login',        'AuthController@login');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('logout',    'AuthController@logout');
        Route::get('user',      'AuthController@getUser');
    });

    Route::any('{segment}', function () {
        return response()->json(['error' => 'Bad request.'], 400);
    })->where('segment', '.*');
});

Route::get('unauthorized', function () {
    return response()->json(['error' => 'Unauthorized.'], 401);
})->name('unauthorized');
