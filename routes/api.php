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
Route::get('/get-features', 'API\PropertyController@getFeatures');
Route::get('/get-towns', 'API\PropertyController@getTowns');
Route::post('/image/store', 'API\PropertyController@imageStore');
Route::post('/search', 'API\PropertyController@searchProperties');



Route::middleware('auth:api')->get('/profile', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'API\AuthController@logout');
    Route::post('/profile/change-info', 'API\UserController@changeUserData');
    Route::post('/profile/change-pass', 'API\UserController@changeUserPass');
    Route::post('/create', 'API\PropertyController@createProperty');
    Route::get('/myproperties', 'API\PropertyController@showUserProperties');
    Route::get('/myproperties/requests', 'API\PropertyController@showIncomingRequests');
    Route::post('/myproperties/approve', 'API\PropertyController@approveIncomingRequest');
    Route::post('/myproperties/reject', 'API\PropertyController@rejectIncomingRequest');
    Route::get('/properties/{id}', 'API\PropertyController@showProperty');
    Route::get('/delete/{id}', 'API\PropertyController@deleteProperty');
    Route::post('/edit', 'API\PropertyController@editProperty');
    Route::post('/book/{id}', 'API\BookingController@bookingRequest');
    Route::get('/get-auth-user', 'API\AuthController@getAuthUser');
});

