<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'api'], function() {
    Route::post('flare', 'PublicApiController@sendFlare');
    ROute::get('flare', 'PublicApiController@getFlares')->middleware('checkRole');
    Route::get('getUserId', 'PublicApiController@getUserId');
});

Route::get('/test', 'PageController@test');
Route::get('/profile', 'PageController@profile')->middleware('auth');

Auth::routes();

Route::get('/', 'PageController@index');
