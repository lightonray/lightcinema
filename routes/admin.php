<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\MovieController;
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

Route::get('admin/home', [AdminController::class, 'index'])->middleware(RedirectIfAuthenticated::class)->name('home');

/**
 * Admin Routes
 */
Route::prefix('admin')->group(function () {

    /**
     * Movie Routes
     */
    Route::get('/movies', [MovieController::class, 'allMovies'])->name('admin.movies.index');
    Route::get('/edit/{id}/movies', [MovieController::class, 'editMovie'])->name('admin.movies.edit');
    Route::post('/edit/movies/{id}', [MovieController::class, 'updateMovie'])->name('admin.movies.update');
    Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('admin.movies.destroy');

    /**
     * User Routes
     */
    Route::get('/users', [UserController::class, 'allUsers'])->name('admin.users.index');
    Route::get('/edit/{id}/users', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/edit/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    /**
     * Genre Routes
     */
    Route::get('/genres', [GenreController::class, 'allGenres'])->name('admin.genres.index');
    Route::get('/edit/{id}/genres', [GenreController::class, 'edit'])->name('admin.genres.edit');
    Route::post('/edit/genres/{id}', [GenreController::class, 'update'])->name('admin.genres.update');
    Route::delete('/genres/{id}', [GenreController::class, 'destroy'])->name('admin.genres.destroy');
});

