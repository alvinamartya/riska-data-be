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


use App\Http\RestResponse;

Route::get('/', function (){
  return RestResponse::message("Hi.");
})->name('default');


Route::group(['prefix' => 'v1', 'namespace' => 'v1'], function () {

  Route::get('auth/login', 'AuthController@login')->name('auth.login');
  Route::get('auth/callback', 'AuthController@callback')->name('auth.callback');
  Route::get('auth/logout', 'AuthController@logout')->name('auth.logout');
  Route::get('auth/refresh', 'AuthController@refresh')->name('auth.refresh');
  Route::get('auth/me', 'AuthController@me')->name('auth.me');

  Route::post('auth/whatsapp', 'AuthController@loginByWhatsapp')->name('auth.whatsapp');

  Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('users', 'UserController')->except(['create', 'edit', 'store', 'destroy', 'update']);
    Route::resource('roles', 'RoleController')->except(['create', 'edit']);
    Route::resource('permissions', 'PermissionController')->except(['create', 'edit']);
    Route::resource('roles.permissions', 'RolePermissionController')->except(['create', 'edit', 'show', 'update']);
    Route::resource('roles.users', 'RoleMemberController')->except(['create', 'edit', 'show']);
    Route::resource('batches', 'BatchController')->except(['create', 'edit']);
    Route::resource('suggestions','SuggestionController')->except(['create', 'edit']);
    Route::resource('suggestion-groups','SuggestionGroupController')->except(['create', 'edit', 'destroy']);
    Route::resource('departments', 'DepartmentController')->except(['create', 'edit']);
    Route::resource('users.events', 'UserEventController')->except(['create','edit']);
    Route::resource('users.organizations', 'UserOrganizationController')->except(['create','edit']);
    Route::resource('talents', 'TalentController')->except(['create', 'edit']);

    Route::post('users-import', 'UserController@import')->name('users.import');
  });

  Route::resource('whatsapp-bots', 'WhatsappBotController')->except(['create','edit']);
  Route::resource('whatsapp-bots.inboxes', 'WhatsappInboxController')->except(['create','edit']);
  Route::resource('whatsapp-bots.outboxes', 'WhatsappOutboxController')->except(['create','edit']);
});
