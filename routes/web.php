<?php

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
Route::get('/addmovie', [MovieController::class, 'adMoviePage'])->name('addmovie-index');
Route::get('/moviedetails', [MovieController::class, 'movieDetailsPage'])->name('moviedetails-index');
Route::post('/createmovie', [MovieController::class, 'addMovie'])->name('movie.store');
