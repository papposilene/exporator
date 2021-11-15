<?php


use App\Http\Controllers\Backend\ExhibitionController;
use App\Http\Controllers\Backend\PlaceController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Livewire\Dashboard\ShowAbout;
use App\Http\Livewire\Dashboard\ShowDashboard;
use App\Http\Livewire\Exhibition\CalendarExhibition;
use App\Http\Livewire\Exhibition\ListExhibition;
use App\Http\Livewire\Exhibition\MapExhibition;
use App\Http\Livewire\Exhibition\ShowExhibition;
use App\Http\Livewire\Exhibition\TimelineExhibition;
use App\Http\Livewire\Place\ListPlace;
use App\Http\Livewire\Place\ShowPlace;
use App\Http\Livewire\Review\CreateReview;
use App\Http\Livewire\Statistic\ShowStatistic;
use App\Http\Livewire\Tag\ListTag;
use App\Http\Livewire\Tag\ShowTag;
use App\Http\Livewire\Tag\ShowType;
use App\Http\Livewire\User\ListUser;
use App\Http\Livewire\User\ShowUser;
use App\Http\Livewire\User\ListActivity;
use App\Http\Livewire\User\ShowActivity;
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
Route::get('/statistics', ShowStatistic::class)->name('front.stat');

// Museums
Route::get('/places', ListPlace::class)->name('front.place.index');
Route::get('/place/{slug}', ShowPlace::class)->name('front.place.show');

// Exhibitions
Route::get('/exhibitions', ListExhibition::class)->name('front.exhibition.index');
Route::get('/place/{place}/exhibition/{slug}', ShowExhibition::class)->name('front.exhibition.show');
Route::get('/exhibitions/calendar', CalendarExhibition::class)->name('front.exhibition.calendar');
Route::get('/exhibitions/map', MapExhibition::class)->name('front.exhibition.map');
Route::get('/exhibitions/timeline', TimelineExhibition::class)->name('front.exhibition.timeline');
Route::post('/exhibitions/propose', [ExhibitionController::class, 'propose'])->name('front.exhibition.propose');

// Reviews
Route::get('/reviews', ListUser::class)->name('front.review.index');
Route::get('/review/{slug}', ShowUser::class)->name('front.review.show');

// Tags
Route::get('/tags', ListTag::class)->name('front.tag.index');
Route::get('/tag/{slug}', ShowTag::class)->name('front.tag.show');
//Route::get('/tag/type/{slug}', ShowType::class)->name('front.tag.type');

// Users
Route::get('/users', ListUser::class)->name('front.user.index');
Route::get('/user/{uuid}', ShowUser::class)->name('front.user.show');
Route::get('/activities', ListActivity::class)->name('front.activity.index');
Route::get('/activity/{activity_id}', ShowActivity::class)->name('front.activity.show');

/*
|--------------------------------------------------------------------------
| Backend
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth:sanctum', 'verified'])->group(function () {
    // Places
    Route::post('/place/store', [PlaceController::class, 'store'])->name('admin.place.store');
    Route::post('/place/update', [PlaceController::class, 'update'])->name('admin.place.update');
    Route::post('/places/import', [PlaceController::class, 'import'])->name('admin.place.import');

    // Exhibitions
    Route::post('/exhibition/store', [ExhibitionController::class, 'store'])->name('admin.exhibition.store');
    Route::post('/exhibition/update', [ExhibitionController::class, 'update'])->name('admin.exhibition.update');
    Route::post('/exhibitions/import', [ExhibitionController::class, 'import'])->name('admin.exhibition.import');
    Route::post('/exhibitions/publish', [ExhibitionController::class, 'publish'])->name('admin.exhibition.publish');

    // Review
    Route::get('/review/create/{uuid}', CreateReview::class)->name('admin.review.create');
    Route::post('/review/store', [ReviewController::class, 'store'])->name('admin.review.store');
    Route::post('/review/update', [ReviewController::class, 'update'])->name('admin.review.update');
    Route::post('/review/delete', [ReviewController::class, 'delete'])->name('admin.review.delete');

    // Tag
    Route::post('/tag/store', [TagController::class, 'store'])->name('admin.tag.store');
    Route::post('/tag/update', [TagController::class, 'update'])->name('admin.tag.update');
    Route::post('/tag/attach', [TagController::class, 'attach'])->name('admin.tag.attach');
    Route::post('/tag/delete', [TagController::class, 'delete'])->name('admin.tag.delete');

    // User
    Route::post('/user/place/follow', [UserController::class, 'place_follow'])->name('admin.user.place_follow'); // Follow a place
    Route::post('/user/place/unfollow', [UserController::class, 'place_unfollow'])->name('admin.user.place_unfollow'); // Unfollow a place
    Route::post('/user/exhibition/follow', [UserController::class, 'exhibition_follow'])->name('admin.user.exhibition_follow'); // Follow an exhibition
    Route::post('/user/exhibition/visited', [UserController::class, 'exhibition_visited'])->name('admin.user.exhibition_visited'); // Exhibition visited
    Route::post('/user/exhibition/unfollow', [UserController::class, 'exhibition_unfollow'])->name('admin.user.exhibition_unfollow'); // Unfollow an exhibition
    Route::post('/user/exhibition/unvisited', [UserController::class, 'exhibition_unvisited'])->name('admin.user.exhibition_unvisited'); // Exhibition visited
    Route::post('/user/tag/follow', [UserController::class, 'tag_follow'])->name('admin.user.tag_follow'); // Follow a tag
    Route::post('/user/tag/unfollow', [UserController::class, 'tag_unfollow'])->name('admin.user.tag_unfollow'); // Unfollow a tag
});
