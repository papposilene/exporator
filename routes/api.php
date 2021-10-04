<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\ExhibitionController;
use App\Http\Controllers\API\MuseumController;

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

Route::prefix('1.1')->group(function () {
    // Countries
    Route::get('/countries', [CountryController::class, 'index'])->name('api.country.index');
    Route::get('/countries/{cca3}', [CountryController::class, 'show'])->name('api.country.show');

    // Museums
    Route::get('/museums', [MuseumController::class, 'index'])->name('api.museum.index');
    Route::get('/museums/geojson', [MuseumController::class, 'geojson'])->name('api.museum.geojson');
    Route::get('/museum/{slug}', [MuseumController::class, 'show'])->name('api.museum.show');

    // Exhibitions
    Route::get('/exhibitions', [ExhibitionController::class, 'index'])->name('api.exhibition.index');
    Route::get('/exhibition/timeline', [ExhibitionController::class, 'json'])->name('api.exhibition.timeline');
    Route::get('/exhibition/{slug}', [ExhibitionController::class, 'show'])->name('api.exhibition.show');
});
