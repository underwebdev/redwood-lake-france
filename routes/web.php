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
Route::get('stock/id', [PageController::class, 'fish']);
Route::get('catch-reports', [PageController::class, 'reports']);
Route::get('rules', [PageController::class, 'rules']);
Route::get('facilities', [PageController::class, 'facilities']);
Route::get('location', [PageController::class, 'location']);
Route::get('news', [PageController::class, 'news']);
Route::get('photo-diary', [PageController::class, 'diary']);
Route::get('weather', [PageController::class, 'weather']);
Route::get('contact', [PageController::class, 'contact']);
Route::get('regulations', [PageController::class, 'regulations']);
Route::get('booking-terms', [PageController::class, 'bookingterms']);
Route::get('terms-conditions', [PageController::class, 'terms']);
Route::get('privacy-policy', [PageController::class, 'privacy']);
Route::get('covid-19', [PageController::class, 'covid']);