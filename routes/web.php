<?php


use App\Http\Controllers\Backend\ExhibitionController;
use App\Http\Controllers\Backend\MuseumController;
use App\Http\Livewire\Country\ListCountry;
use App\Http\Livewire\Country\ShowCountry;
use App\Http\Livewire\Dashboard\ShowAbout;
use App\Http\Livewire\Dashboard\ShowDashboard;
use App\Http\Livewire\Exhibition\ListExhibition;
use App\Http\Livewire\Exhibition\MapExhibition;
use App\Http\Livewire\Exhibition\ProposeExhibition;
use App\Http\Livewire\Exhibition\ShowExhibition;
use App\Http\Livewire\Exhibition\TimelineExhibition;
use App\Http\Livewire\Museum\ListMuseum;
use App\Http\Livewire\Museum\ShowMuseum;
use App\Http\Livewire\Tag\ListTag;
use App\Http\Livewire\Tag\ShowTag;
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


/*
|--------------------------------------------------------------------------
| Frontend
|--------------------------------------------------------------------------
*/
Route::redirect('/', '/dashboard', 301);
Route::get('/dashboard', ShowDashboard::class)->name('dashboard');
Route::get('/about', ShowAbout::class)->name('front.about');

// Museums
Route::get('/museums', ListMuseum::class)->name('front.museum.index');
Route::get('/museum/{slug}', ShowMuseum::class)->name('front.museum.show');

// Exhibitions
Route::get('/exhibitions', ListExhibition::class)->name('front.exhibition.index');
Route::get('/museum/{museum}/exhibition/{exhibition}', ShowExhibition::class)->name('front.exhibition.show');
Route::get('/exhibitions/propose', ProposeExhibition::class)->name('front.exhibition.propose');
Route::get('/exhibitions/map', MapExhibition::class)->name('front.exhibition.map');
Route::get('/exhibitions/timeline', TimelineExhibition::class)->name('front.exhibition.timeline');

// Exhibitions
Route::get('/tags', ListTag::class)->name('front.tag.index');
Route::get('/tag/{slug}', ShowTag::class)->name('front.tag.show');

/*
|--------------------------------------------------------------------------
| Backend
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth:sanctum', 'verified'])->group(function () {
    //Route::redirect('/', '/dashboard', 301);
    //Route::get('/dashboard', ShowDashboard::class)->name('admin.dashboard');

    // Countries
    Route::get('/countries', ListCountry::class)->name('admin.country.index');
    Route::get('/country/{cca3}', ShowCountry::class)->name('admin.country.show');

    // Museums
    Route::get('/museums', ListMuseum::class)->name('admin.museum.index');
    Route::post('/museums/store', [MuseumController::class, 'store'])->name('admin.museum.store');
    Route::post('/museums/import', [MuseumController::class, 'import'])->name('admin.museum.import');
    Route::get('/museum/{slug}', ShowMuseum::class)->name('admin.museum.show');
    Route::post('/museum/update', [MuseumController::class, 'update'])->name('admin.museum.update');

    // Exhibitions
    Route::get('/exhibitions', ListExhibition::class)->name('admin.exhibition.index');
    Route::post('/exhibitions/import', [ExhibitionController::class, 'import'])->name('admin.exhibition.import');
    Route::get('/museum/{museum}/exhibition/{exhibition}', ShowExhibition::class)->name('admin.exhibition.show');
    Route::post('/exhibition/store', [ExhibitionController::class, 'store'])->name('admin.exhibition.store');
    Route::post('/exhibition/update', [ExhibitionController::class, 'update'])->name('admin.exhibition.update');
    Route::get('/exhibitions/propose', [ExhibitionController::class, 'propose'])->name('admin.exhibition.propose');
});

Route::view('/{path?}', 'app')->where('path', '.*')->name('nuxt');
