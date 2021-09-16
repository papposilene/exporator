<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->middleware(['auth:sanctum', 'verified'])->namespace('Backend')->group(function () {
    // Countries
    Route::get('/countries', 'CountryController@index')->name('api.country.index');
    Route::get('/countries/{cca3}', 'CountryController@show')->name('api.country.show');

    // Museums
    Route::get('/museums', 'MuseumController@index')->name('api.museum.index');
    Route::get('/museum/{slug}', 'MuseumController@show')->name('api.museum.show');

    // Exhibitions
    Route::get('/exhibitions', 'ExhibitionController@index')->name('api.exhibition.index');
    Route::get('/exhibition/{slug}', 'ExhibitionController@show')->name('api.exhibition.show');
});

Route::view('/{path?}', 'app')->where('path', '.*')->name('nuxt');
