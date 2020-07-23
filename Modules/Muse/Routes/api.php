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


Route::group([
    'prefix' => 'muse',
    'middleware'    => 'jwt.auth'
], function () {
    Route::group([
        'prefix'    => 'songs'
    ], function () {
        Route::get('/{songID?}', 'SongsController@get');
        Route::post('/', 'SongsController@create');
        Route::put('/{songID}', 'SongsController@update');
        Route::delete('/{songID}', 'SongsController@delete');
    });
    Route::group([
        'prefix'    => 'artists'
    ], function () {
        Route::get('/{artistID?}', 'ArtistsController@get');
        Route::post('/', 'ArtistsController@create');
        Route::put('/{artistID}', 'ArtistsController@update');
        Route::delete('/{artistID}', 'ArtistsController@delete');
    });
    Route::group([
        'prefix'    => 'albums'
    ], function () {
        Route::get('/{albumID?}', 'AlbumsController@get');
        Route::post('/', 'AlbumsController@create');
        Route::put('/{albumID}', 'AlbumsController@update');
        Route::delete('/{albumID}', 'AlbumsController@delete');
    });
});
