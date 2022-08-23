<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;

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

Route::get('admin/dashboard', [AdminController::class, 'index']);
Route::get('admin/bookings', [AdminController::class, 'bookings']);
Route::get('admin/bookings/{id}', [AdminController::class, 'booking']);
Route::get('admin/anglers', [AdminController::class, 'anglers']);
Route::get('admin/catch-reports', [AdminController::class, 'catchreport']);
Route::get('admin/stock', [AdminController::class, 'stock']);
Route::get('admin/stock/{id}', [AdminController::class, 'fish']);
Route::get('admin/stocking-diary', [AdminController::class, 'stockdiary']);
Route::get('admin/lake', [AdminController::class, 'lake']);
Route::get('admin/news', [AdminController::class, 'news']);
Route::get('admin/news/{id}', [AdminController::class, 'article']);
Route::get('admin/photo-diary', [AdminController::class, 'photodiary']);
Route::get('admin/content', [AdminController::class, 'content']);
Route::get('admin/rules', [AdminController::class, 'rules']);
Route::get('admin/booking-terms', [AdminController::class, 'terms']);
Route::get('admin/reviews', [AdminController::class, 'reviews']);
Route::get('admin/pricing', [AdminController::class, 'pricing']);
Route::get('admin/payments', [AdminController::class, 'payments']);
Route::get('admin/payouts', [AdminController::class, 'payouts']);
Route::get('admin/discounts', [AdminController::class, 'discounts']);
Route::get('admin/financial', [AdminController::class, 'financial']);
Route::get('admin/mailing-list', [AdminController::class, 'mailshot']);
Route::get('admin/inbox', [AdminController::class, 'inbox']);
Route::get('admin/settings', [AdminController::class, 'settings']);