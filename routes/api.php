<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('get-tournament-data', [ApiController::class,'getTournamentData']);
Route::post('add-game-score', [ApiController::class,'addGameScore']);
Route::get('reward-assign', [ApiController::class,'rewardAssign']);
Route::get('affiliate-users', [ApiController::class,'affiliateUser']);
Route::get('tournament-status', [ApiController::class,'tournamentStatus']);
Route::post('tournament-game-start',[ApiController::class,'startGame']);