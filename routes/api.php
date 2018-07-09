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

Route::post('login', 'UserController@login')->name('login');
Route::post('register', 'UserController@register');
 
Route::middleware('auth:api')->group(function () {
    Route::get('user_info', 'UserController@details');
 
    Route::resource('users', 'UserController');
});
