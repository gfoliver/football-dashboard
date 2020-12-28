<?php

use App\Http\Controllers\LeagueController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/teams')->group(function() {
    Route::post('/', [TeamController::class, 'save'])->name('api.teams.save');

    Route::delete('/{id}', [TeamController::class, 'delete'])->name('api.teams.delete');
});

Route::prefix('/leagues')->group(function() {
    Route::delete('/{id}',[LeagueController::class, 'delete'])->name('api.leagues.delete');
});
