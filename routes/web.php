<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

Route::get('/', [PageController::class, 'index']);
Route::get('booking', [PageController::class, 'booking']);
Route::get('deposit', [PageController::class, 'deposit']);
Route::get('lake', [PageController::class, 'lake']);
Route::get('stock', [PageController::class, 'stock']);
Route::get('catch-reports', [PageController::class, 'reports']);
Route::get('rules', [PageController::class, 'rules']);
Route::get('facilities', [PageController::class, 'facilities']);
Route::get('location', [PageController::class, 'location']);
Route::get('news', [PageController::class, 'news']);
Route::get('photo-diary', [PageController::class, 'diary']);
Route::get('weather', [PageController::class, 'weather']);
Route::get('contact', [PageController::class, 'contact']);