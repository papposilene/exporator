<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\CountryController;
use App\Http\Controllers\Frontend\ExhibitionController;
use App\Http\Controllers\Frontend\MuseumController;

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

Route::prefix('admin')->middleware(['auth:sanctum', 'verified'])->group(function () {
    // Countries
    Route::get('/countries', [CountryController::class, 'index'])->name('api.country.index');
    Route::get('/countries/{cca3}', [CountryController::class, 'show'])->name('api.country.show');

    // Museums
    Route::get('/museums', [MuseumController::class, 'index'])->name('api.museum.index');
    Route::get('/museum/{slug}', [MuseumController::class, 'show'])->name('api.museum.show');

    // Exhibitions
    Route::get('/exhibitions', [ExhibitionController::class, 'index'])->name('api.exhibition.index');
    Route::get('/exhibition/{slug}', [ExhibitionController::class, 'show'])->name('api.exhibition.show');
});

Route::view('/{path?}', 'app')->where('path', '.*')->name('nuxt');
