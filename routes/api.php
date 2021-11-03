<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\ExhibitionController;
use App\Http\Controllers\API\PlaceController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\UserController;

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

    // Places
    Route::get('/places', [PlaceController::class, 'index'])->name('api.place.index');
    Route::get('/places/geojson', [PlaceController::class, 'geojson'])->name('api.place.geojson');
    Route::get('/place/{slug}', [PlaceController::class, 'show'])->name('api.place.show');

    // Exhibitions
    Route::get('/exhibitions', [ExhibitionController::class, 'index'])->name('api.exhibition.index');
    Route::get('/exhibitions/all', [ExhibitionController::class, 'all'])->name('api.exhibition.all');
    Route::get('/exhibition/timeline', [ExhibitionController::class, 'json'])->name('api.exhibition.timeline');
    Route::get('/exhibition/{slug}', [ExhibitionController::class, 'show'])->name('api.exhibition.show');

    // Tags
    Route::get('/tags', [TagController::class, 'index'])->name('api.tag.index');
    Route::get('/tag/{slug}', [TagController::class, 'show'])->name('api.tag.show');
    
    // Users
    Route::get('/user/{id}', [UserController::class, 'show'])->name('api.user.show');
});
