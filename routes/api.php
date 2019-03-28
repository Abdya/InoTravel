<?php

use Illuminate\Http\Request;

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

Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');
Route::post('/password-reset/request', 'API\AuthController@passwordReset');
Route::post('/password-reset/confirm', 'API\AuthController@passwordResetConfirm');
Route::post('/profile/change-info', 'API\UserController@changeUserData');
Route::post('/profile/change-pass', 'API\UserController@changeUserPass');
Route::get('/property/create/get-features', 'API\PropertyController@getFeatures');
Route::get('/property/create/get-towns', 'API\PropertyController@getTowns');

Route::middleware('auth:api')->get('/profile', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'API\AuthController@logout');
    Route::post('/profile/change-info', 'API\UserController@changeUserData');
    Route::post('/profile/change-pass', 'API\UserController@changeUserPass');
    Route::post('/property/create', 'API\PropertyController@createProperty');
    Route::get('/myproperties', 'API\PropertyController@showUserProperties');
    Route::get('/myproperties/requests', 'API\PropertyController@showIncomingRequests');
    Route::post('/myproperties/approve', 'API\PropertyController@approveIncomingRequest');
    Route::post('/myproperties/reject', 'API\PropertyController@rejectIncomingRequest');
});

