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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', ['middleware' => 'json', 'uses' => 'AuthController@login']);
   // Route::get('/refresh', ['uses' => 'CustomRefreshTokenController@refreshToken', 'middleware' => 'jwt.auth']);
});
