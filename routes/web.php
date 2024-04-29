<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\LandingController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Arquivei\LaravelPrometheusExporter\Http\Controller as PrometheusController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

/**
 * Route for showing user landing page
 */
Route::get('/', [HomeController::class, 'showLandingPage'])->name('landing');


Route::get('/metrics', [PrometheusController::class, 'getMetrics']);
/**
 * Movie Routes User
 */
Route::get('/addmovie', [MovieController::class, 'addMoviePage'])->name('addmovie-index');
Route::get('/movie/{id}', [HomeController::class, 'movieDetailsPage'])->name('moviedetails-index');
Route::post('/createmovie', [MovieController::class, 'addMovie'])->name('movie.store');

/**
 * Routes related to rating on movies
 */
Route::post('movie/{movieId}/rate', [MovieController::class, 'submitRating'])->name('submit-rating');

/**
 * Routes related to comments on movies
 */
Route::get('/comments', [MovieController::class, 'comments'])->name('comments.index');
Route::post('/comments', [MovieController::class, 'submitComment'])->name('comment.store'); 


include __DIR__.'/admin.php';

