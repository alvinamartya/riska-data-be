<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'namespace'  => 'v1'], function () {

  Route::group(['prefix' => 'auth', 'middleware' => 'api'], function () {
    Route::get('login', 'AuthController@login');
    Route::get('callback', 'AuthController@callback');
    Route::get('logout', 'AuthController@logout');
    Route::get('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
  });
});
