<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Country\ListCountry;
use App\Http\Livewire\Country\ShowCountry;
use App\Http\Livewire\Exhibition\ListExhibition;
use App\Http\Livewire\Exhibition\ShowExhibition;
use App\Http\Livewire\Museum\ListMuseum;
use App\Http\Livewire\Museum\ShowMuseum;

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
    Route::get('/countries', ListCountry::class)->name('admin.country.index');
    Route::get('/country/{cca3}', ShowCountry::class)->name('admin.country.show');

    // Museums
    Route::get('/museums', ListMuseum::class)->name('admin.museum.index');
    Route::get('/museum/{slug}', ShowMuseum::class)->name('admin.museum.show');

    // Exhibitions
    Route::get('/exhibitions', ListExhibition::class)->name('admin.exhibition.index');
    Route::get('/exhibition/{slug}', ShowExhibition::class)->name('admin.exhibition.show');
});



Route::view('/{path?}', 'app')->where('path', '.*')->name('nuxt');
