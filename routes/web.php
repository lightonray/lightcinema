<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\LandingController;
use App\Http\Middleware\RedirectIfAuthenticated;

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

Route::get('/', [LandingController::class, 'showLandingPage'])->name('landing');
Route::get('/home', [HomeController::class, 'index'])->middleware(RedirectIfAuthenticated::class)->name('home');
Route::get('/addmovie', [MovieController::class, 'addMoviePage'])->name('addmovie-index');
Route::get('/movie/{id}', [MovieController::class, 'movieDetailsPage'])->name('moviedetails-index');
Route::post('/createmovie', [MovieController::class, 'addMovie'])->name('movie.store');


Route::post('movie/{movieId}/rate', [MovieController::class, 'submitRating'])->name('submit-rating');
Route::get('/comments', [MovieController::class, 'comments'])->name('comments.index');
Route::post('/comments', [MovieController::class, 'submitComment'])->name('comment.store'); 


Route::get('/admin/movies', [AdminController::class, 'allMovies'])->name('movies-index');

