<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
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

Route::get('/home', [AdminController::class, 'index'])->middleware(RedirectIfAuthenticated::class)->name('home');

Route::get('/admin/movies', [MovieController::class, 'allMovies'])->name('admin.movies.index');
Route::get('/edit{id}/movies', [MovieController::class, 'editMovie'])->name('admin.movies.edit');
Route::post('edit/movies/{id}', [MovieController::class, 'updateMovie'])->name('admin.movies.update');

Route::get('/admin/users', [UserController::class, 'allUsers'])->name('admin.users.index');


