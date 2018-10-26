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

Route::get('/cover', function () {
    return view('cover');
});
Route::get('/properties', 'Properties@list');
Route::get('/properties/{id}', 'Properties@singleProperty');
Route::get('/requests', function () {
    return view('requests');
});
Route::get('/profile/properties', function () {
    return view('myProperties');
});
Route::get('/profile/properties/create', function () {
    return view('createProperty');
});
Route::get('/profile/properties/{id}', function () {
    return view('singleUserProperty');
});
Route::get('/profile/properties/{id}/edit', 'Profile@showUserPropertyInfo');
Route::get('/profile', 'Profile@showUserInfo');