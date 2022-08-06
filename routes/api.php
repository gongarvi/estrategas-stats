<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\SessionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('game', GameController::class)->only([
    'index', 'show', 'store'
]);

Route::resource('game/{game}/session', SessionController::class, [
    "names"=> [
        "store" => "session.store"
    ]
])->only([
    'store'
]);

Route::get("/batch",[SessionController::class, "batch"]);
// Route::middleware('cache.headers:public;max_age=2628000')->group(function () {
    
// });