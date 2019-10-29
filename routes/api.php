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
 
Route::group([
    'middleware' => 'api', 
    'prefix' => 'auth'
], function () {
  Route::get('login', 'AuthController@login')->name("auth.login");
  Route::get('callback', 'AuthController@callback')->name("auth.callback");
  Route::get('logout', 'AuthController@logout')->name("auth.logout");
  Route::get('refresh', 'AuthController@refresh')->name("auth.refresh");
  Route::get('me', 'AuthController@me')->name("auth.me");
});
