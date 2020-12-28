<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\LeagueController;

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

Route::get('/', [ContentController::class, 'home'])->name('site.home');

Route::prefix('/teams')->group(function() {
    Route::get('/', [TeamController::class, 'index'])->name('site.teams');

    Route::get('/form/{id?}', [TeamController::class, 'form'])->name('site.teams.form');
});

Route::prefix('/leagues')->group(function() {
    Route::get('/', [LeagueController::class, 'index'])->name('site.leagues');

    Route::get('/{id}', [LeagueController::class, 'inner'])->name('site.leagues.inner');
});
