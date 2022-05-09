<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;
use App\Http\Controllers\Api\MenuItemController;
use App\Http\Controllers\Api\MenuItemDayController;
use App\Http\Controllers\Api\MenuItemWeekController;
use App\Http\Controllers\Api\MealCountController;
use App\Http\Controllers\Api\CookbookController;
use App\Http\Controllers\Api\MealImageController;
use App\Http\Controllers\Api\MealtypeController;
use App\Http\Controllers\Api\MealController;
use App\Http\Controllers\Api\MealFilterController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\HomeController;

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

// Can be guest or logged in user
Route::get('/', [MainController::class, 'index']);

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth']);

Route::group(['prefix' => 'api'], function () {
    Route::get('/user', [UserController::class, 'show']);
});


// Admin routes that need authorisation
Route::group(['middleware' => 'auth', 'prefix' => 'api'], function () {

    // Single based
    Route::resource('/menuitems', MenuItemController::class)->except(['create', 'edit']);

    Route::put('/menuitems/shiftup/{id}', [MenuItemController::class, 'updateAndShiftUp']);
    Route::put('/menuitems/shiftdown/{id}', [MenuItemController::class, 'updateAndShiftDown']);

    // Menu items per day
    Route::get('/menuitems/day/{date}', [MenuItemDayController::class, 'show'])->where('date', '([0-9]{4})-([0-9]{2})-([0-9]{2})');

    // Menu items per week
    Route::get('/menuitems/week/{date}', [MenuItemWeekController::class, 'show'])->where('date', '([0-9]{4})-([0-9]{2})-([0-9]{2})');

    // Meal images
    Route::post('/meal/image', [MealImageController::class, 'create']);
    Route::delete('/meal/image/{imageId}', [MealImageController::class, 'destroy']);

    Route::post('/meals/filter', [MealFilterController::class, 'index']);
    Route::put('/meals/count', [MealCountController::class, 'update']);
    Route::resource('/meals', MealController::class)->except(['create', 'edit']);

    Route::get('/mealtypes/all', [MealtypeController::class, 'getAll']);

    Route::resource('/mealtypes', MealtypeController::class)->except(['create', 'edit']);

    Route::get('/cookbooks/all', [Cookbookcontroller::class, 'getAll']);
    Route::resource('/cookbooks', CookbookController::class)->except(['create', 'edit']);
});

// All other routes to Vue Router via Api?
Route::get('/{vue?}', [MainController::class, 'index'])->where('vue', '.*')->middleware('auth');
