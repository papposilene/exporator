<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('1.1')->namespace('API')->group(function () {
    // Museums
    Route::get('/museums', 'MuseumController@index')->name('api.museum.index');
    Route::get('/museum/{slug}', 'MuseumController@show')->name('api.museum.show');

    // Exhibitions
    Route::get('/exhibitions', 'ExhibitionController@index')->name('api.exhibition.index');
    Route::get('/exhibition/{slug}', 'ExhibitionController@show')->name('api.exhibition.show');
});
