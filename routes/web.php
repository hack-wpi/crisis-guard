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
    Route::get('flare', 'PublicApiController@getFlares')->middleware('checkRole');
    Route::get('getUserId', 'PublicApiController@getUserId');
    Route::get('nearByProfile', 'PublicApiController@nearByProfile');
    Route::post('uploadProfilePicture', 'PublicApiController@uploadProfilePicture');
    Route::post('uploadTrainingPicture', 'PublicApiController@uploadTrainingPicture');
    Route::post('uploadProductionPicture', 'PublicApiController@uploadProductionPicture');
    Route::get('getProductionJson', 'PublicApiController@getProductionJson');
});

Route::get('/profile', 'PageController@profile')->middleware('auth');

Route::group(['prefix' => 'users'], function () {
    Route::any('updateProfilePicture', 'UserController@updateProfilePicture');
});
Route::get('/test', 'PageController@test');

Auth::routes();

Route::get('/', 'PageController@index');
