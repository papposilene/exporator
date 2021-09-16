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
    // Museums
    Route::get('/museums', 'MuseumController@index')->name('api.museum.index');
    Route::get('/museum/{uuid}', 'MuseumController@show')->name('api.museum.show');

    // Exhibitions
    Route::get('/exhibitions', 'ExhibitionController@index')->name('api.exhibition.index');
    Route::get('/exhibition/{uuid}', 'ExhibitionController@show')->name('api.exhibition.show');
});

Route::view('/{path?}', 'app')->where('path', '.*')->name('nuxt');
