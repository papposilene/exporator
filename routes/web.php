<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\ExhibitionController;
use App\Http\Controllers\Backend\MuseumController;

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
    Route::view('/dashboard', 'app')->name('dashboard');

    // Countries
    Route::get('/countries', [CountryController::class, 'index'])->name('admin.country.index');
    Route::get('/countries/{cca3}', [CountryController::class, 'show'])->name('admin.country.show');

    // Museums
    Route::get('/museums', [MuseumController::class, 'index'])->name('admin.museum.index');
    Route::get('/museum/{slug}', [MuseumController::class, 'show'])->name('admin.museum.show');

    // Exhibitions
    Route::get('/exhibitions', [ExhibitionController::class, 'index'])->name('admin.exhibition.index');
    Route::get('/exhibition/{slug}', [ExhibitionController::class, 'show'])->name('admin.exhibition.show');
});



Route::view('/{path?}', 'app')->where('path', '.*')->name('nuxt');
