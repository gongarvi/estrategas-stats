<?php

use App\Http\Controllers\StadisticsController;
use App\Http\Middleware\RefreshSession;
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

Route::middleware([RefreshSession::class])->group(function(){
    Route::get('/', [StadisticsController::class, 'reIndex']);
    Route::get('/save/{id}', [StadisticsController::class, 'save'])->name("save");
});

