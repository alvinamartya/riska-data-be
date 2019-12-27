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

  Route::get('auth/login', 'AuthController@login');
  Route::get('auth/callback', 'AuthController@callback');
  Route::get('auth/logout', 'AuthController@logout');
  Route::get('auth/refresh', 'AuthController@refresh');
  Route::get('auth/me', 'AuthController@me');

  Route::group(['middleware' => 'auth'], function() {
    Route::get('roles', 'RoleController@index');
    Route::post('roles', 'RoleController@store');
    Route::get('roles/{roleId}', 'RoleController@show');
    Route::put('roles/{roleId}', 'RoleController@update');
    Route::delete('roles/{roleId}', 'RoleController@destroy');

    Route::post('roles/{roleId}/users', 'RoleController@attachUser');
    Route::put('roles/{roleId}/users/{userId}', 'RoleController@updateAttachedUser');
    Route::delete('roles/{roleId}/users/{userId}', 'RoleController@detachUser');

    Route::get('permissions', 'PermissionController@index');
    Route::post('permissions', 'PermissionController@store');
    Route::get('permissions/{permissionId}', 'PermissionController@show');
    Route::put('permissions/{permissionId}', 'PermissionController@update');
    Route::delete('permissions/{permissionId}', 'PermissionController@destroy');
  });
});
