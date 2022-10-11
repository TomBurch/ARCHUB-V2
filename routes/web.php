<?php

use App\Http\Controllers\Auth\DiscordController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\BriefingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MissionsController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\MissionMediaController;
use App\Http\Controllers\MissionMaintainerController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Public\JoinController;
use App\Http\Controllers\UserController;

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

Route::controller(DiscordController::class)->group(function () {
    Route::get('/auth/redirect', 'redirect')->name('login');
    Route::get('/auth/callback', 'callback');
});

Route::get('/', [AppController::class, 'index']);
Route::get('/join', [JoinController::class, 'index']);

Route::middleware(['can:access-hub'])->group(function () {
    Route::permanentRedirect('/hub', '/hub/missions');
    Route::get('/hub/users', [UserController::class, 'index']);
    Route::get('/hub/settings', [SettingsController::class, 'index']);

    Route::put('/hub/operations/{operation}', [OperationController::class, 'update']);

    Route::get('/hub/missions', [MissionsController::class, 'index']);
    Route::post('/hub/missions', [MissionController::class, 'store']);
    Route::get('/hub/missions/{mission}', [MissionController::class, 'index']);
    Route::patch('/hub/missions/{mission}', [MissionController::class, 'patch']);
    Route::delete('/hub/missions/{mission}', [MissionController::class, 'delete']);
    Route::post('/hub/missions/{mission}/update', [MissionController::class, 'update']);

    Route::post('/hub/missions/{mission}/comments', [CommentController::class, 'store']);
    Route::delete('/hub/missions/{mission}/comments/{comment}', [CommentController::class, 'delete']);
    Route::put('/hub/missions/{mission}/comments/{comment}', [CommentController::class, 'update']);

    Route::post('/hub/missions/{mission}/notes', [NoteController::class, 'store']);
    Route::delete('/hub/missions/{mission}/notes/{note}', [NoteController::class, 'delete']);
    Route::put('/hub/missions/{mission}/notes/{note}', [NoteController::class, 'update']);

    Route::post('/hub/missions/{mission}/media', [MissionMediaController::class, 'store']);
    Route::delete('/hub/missions/{mission}/media/{media}', [MissionMediaController::class, 'delete']);

    Route::post('/hub/missions/{mission}/maintainer', [MissionMaintainerController::class, 'store']);

    Route::put('/hub/missions/{mission}/briefings/{briefing}', [BriefingController::class, 'update']);
    Route::get('/hub/missions/{mission}/download', [MissionController::class, 'download']);
    Route::post('/hub/missions/{mission}/deploy', [MissionController::class, 'deploy']);
});
