<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\BusinessListingController;
use App\Http\Controllers\Admin\BusinessCategoryController;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//     ]);
// });

if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', [FrontController::class, 'welcome'])->name('welcome');
Route::get('/listings/search', [FrontController::class, 'search']);
Route::get('/view/listing/{listing}', [FrontController::class, 'viewListing'])->name('single.listing');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::resource('categories', BusinessCategoryController::class);
Route::resource('listings', BusinessListingController::class);
