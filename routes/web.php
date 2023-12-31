<?php

use App\Http\Controllers\MovieController;
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

Route::get('/', [MovieController::class, 'index'])->name('home');
Route::get('/movies', [MovieController::class, 'movies'])->name('movies');
Route::get('/tv-show', [MovieController::class, 'tvShow'])->name('tv');
Route::get('/seach', [MovieController::class, 'search'])->name('search');
Route::get('/movie/{id}', [MovieController::class, 'detailMovie'])->name('detail.movie');
Route::get('/tv/{id}', [MovieController::class, 'detailTv'])->name('detail.tv');

