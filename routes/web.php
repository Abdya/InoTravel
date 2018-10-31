<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/properties', 'Properties@list');
Route::get('/properties/{id}', 'Properties@singleProperty');

Route::get('/requests', 'Profile@showRequestInfo')->name('requests');

Route::get('/profile/properties', function () {
    return view('myProperties');
})->name('myProperties');
Route::get('/profile/properties/create', 'CreateProperties@showProperties');
Route::post('/profile/properties/create', 'CreateProperties@createProperty');

Route::get('/profile/properties/{id}', 'Profile@showUserPropertyInfo');

Route::get('/profile/properties/{id}/edit', 'Profile@showUserPropertyInfoForEdit')->name('edit');

Route::get('/profile', 'Profile@showUserInfo')->name('userProfile');
Route::post('/profile', 'Profile@editUserData');
Route::post('/profile/updatePassword', 'Profile@editUserPassword');