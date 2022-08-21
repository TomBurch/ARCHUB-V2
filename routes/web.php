<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\HubController;
use App\Http\Controllers\Auth\DiscordController;
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

// Route::get('/{any}', function () {
//     return view('app');
// })->where('any', '.*');

Route::controller(DiscordController::class)->group(function () {
    Route::get('/auth/redirect', 'redirect')->name('login');
    Route::get('/auth/callback', 'callback');
});

Route::get('/', [AppController::class, 'index']);

Route::middleware(['can:access-hub'])->group(function () {
    Route::get('/hub', [HubController::class, 'index']);
});
