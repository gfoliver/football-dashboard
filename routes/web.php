<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\UserController;

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

Route::get('/register', [ContentController::class, 'register'])->name('site.register');
Route::post('/user', [UserController::class, 'save'])->name('site.user.save');
Route::delete('/user', [UserController::class, 'delete'])->name('site.user.delete');

Route::get('/login', [ContentController::class, 'login'])->name('site.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('site.logout');

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('/teams')->group(function() {
        Route::get('/', [TeamController::class, 'index'])->name('site.teams');
    
        Route::get('/form/{id?}', [TeamController::class, 'form'])->name('site.teams.form');
    
        Route::post('/', [TeamController::class, 'save'])->name('site.teams.save');
    
        Route::delete('/{id}', [TeamController::class, 'delete'])->name('site.teams.delete');
    });
    
    Route::prefix('/leagues')->group(function() {
        Route::get('/', [LeagueController::class, 'index'])->name('site.leagues');
    
        Route::get('/form/{id?}', [LeagueController::class, 'form'])->name('site.leagues.form');
    
        Route::get('/{slug}', [LeagueController::class, 'inner'])->name('site.leagues.inner');
    
        Route::post('/', [LeagueController::class, 'save'])->name('site.leagues.save');
    
        Route::delete('/{id}',[LeagueController::class, 'delete'])->name('site.leagues.delete');
    
        Route::prefix('/{slug}/seasons')->group(function() {
            Route::get('/', [SeasonController::class, 'index'])->name('site.leagues.seasons');
            
            Route::get('/form/{id?}', [SeasonController::class, 'form'])->name('site.leagues.seasons.form');
    
            Route::get('/{id}', [SeasonController::class, 'inner'])->name('site.leagues.seasons.inner');
        
            Route::prefix('/{id}/match')->group(function() {
                Route::get('/', [MatchController::class, 'form'])->name('site.leagues.seasons.match.form');
                Route::post('/', [MatchController::class, 'save'])->name('site.leagues.seasons.match.save');
                Route::delete('/{id}', [MatchController::class, 'delete'])->name('site.leagues.seasons.match.delete');
            });
        });
    
        
        Route::prefix('/seasons')->group(function() {
            Route::post('/', [SeasonController::class, 'save'])->name('site.seasons.save');
            
            Route::delete('/{id}', [SeasonController::class, 'delete'])->name('site.seasons.delete');
        });
    });
});
