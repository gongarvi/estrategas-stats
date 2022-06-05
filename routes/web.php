<?php

use App\Http\Controllers\StadisticsController;
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

Route::get('/', [StadisticsController::class, 'index']);

Route::get('/save/{id}', [StadisticsController::class, 'save'])->name("save");
