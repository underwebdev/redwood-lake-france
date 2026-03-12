<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\EndpointController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\MailhookController;
use App\Http\Controllers\AssetController;

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
Route::get('deposit/{date}', [PageController::class, 'deposit']);
Route::get('lake', [PageController::class, 'lake']);
Route::get('stock', [PageController::class, 'stock']);
Route::get('stock/{stock}', [PageController::class, 'fish']);
Route::get('catch-reports', [PageController::class, 'reports']);
Route::get('rules', [PageController::class, 'rules']);
Route::get('facilities', [PageController::class, 'facilities']);
Route::get('location', [PageController::class, 'location']);
Route::get('news', [PageController::class, 'news']);
Route::get('article/{article}', [PageController::class, 'article']);
Route::get('photo-diary', [PageController::class, 'diary']);
Route::get('weather', [PageController::class, 'openweather']);
Route::get('contact', [PageController::class, 'contact']);
Route::get('booking-terms', [PageController::class, 'bookingterms']);
Route::get('terms-conditions', [PageController::class, 'terms']);
Route::get('privacy-policy', [PageController::class, 'privacy']);
Route::get('payment-complete', [PageController::class, 'paymentcomplete']);
Route::post('payment-webhook', [WebhookController::class, 'handle']);
Route::post('mailhook', [MailhookController::class, 'handle']);

Route::middleware(['angler'])->group(function () {
	Route::get('my-account', [ProfileController::class, 'index']);
	Route::get('my-account/bookings', [ProfileController::class, 'bookings']);
	Route::get('my-account/booking/{booking}', [ProfileController::class, 'booking']);
	Route::get('my-account/payment', [ProfileController::class, 'payment']);
	Route::get('my-account/catch-reports', [ProfileController::class, 'reports']);
	Route::get('my-account/my-reports', [ProfileController::class, 'myreports']);
	Route::get('my-account/update-report/{report}', [ProfileController::class, 'updatereport']);
	Route::get('my-account/upload-report', [ProfileController::class, 'uploadreport']);
	Route::get('my-account/contact', [ProfileController::class, 'contact']);
	Route::get('my-account/settings', [ProfileController::class, 'settings']);
});

Route::middleware(['admin'])->group(function () {
	Route::get('admin/dashboard', [AdminController::class, 'index']);
	Route::get('admin/bookings', [AdminController::class, 'bookings']);
	Route::get('admin/booking/{id}', [AdminController::class, 'booking']);
	Route::get('admin/anglers', [AdminController::class, 'anglers']);
	Route::get('admin/catch-reports', [AdminController::class, 'catchreport']);
	Route::get('admin/stock', [AdminController::class, 'stock']);
	Route::get('admin/stock/{id}', [AdminController::class, 'fish']);
	Route::get('admin/stocking-diary', [AdminController::class, 'stockdiary']);
	Route::get('admin/lake', [AdminController::class, 'lake']);
	Route::get('admin/news', [AdminController::class, 'news']);
	Route::get('admin/article/{url}', [AdminController::class, 'article']);
	Route::get('admin/photo-diary', [AdminController::class, 'photodiary']);
	Route::get('admin/content', [AdminController::class, 'content']);
	Route::get('admin/rules', [AdminController::class, 'rules']);
	Route::get('admin/booking-terms', [AdminController::class, 'terms']);
	Route::get('admin/reviews', [AdminController::class, 'reviews']);
	Route::get('admin/pricing', [AdminController::class, 'pricing']);
	Route::get('admin/payments', [AdminController::class, 'payments']);
	Route::get('admin/payment/{payment}', [AdminController::class, 'payment']);
	Route::get('admin/payouts', [AdminController::class, 'payouts']);
	Route::get('admin/discounts', [AdminController::class, 'discounts']);
	Route::get('admin/financial', [AdminController::class, 'financial']);
	Route::get('admin/mailing-list', [AdminController::class, 'mailshot']);
	Route::get('admin/mailshot/{mailshot}/preview', [AdminController::class, 'previewmail']);
	Route::get('admin/inbox', [AdminController::class, 'inbox']);
	Route::get('admin/settings', [AdminController::class, 'settings']);
	Route::get('admin/storage', [AdminController::class, 'storage']);
	Route::get('admin/emails', [EmailController::class, 'index']);
	Route::get('admin/maillog', [EmailController::class, 'log']);


	Route::get('emails/payment-reminder', [EmailController::class, 'paymentreminder']);
	Route::get('emails/payment-overdue', [EmailController::class, 'overdue']);
	Route::get('emails/guest-information', [EmailController::class, 'guestinfo']);
	Route::get('emails/welcome-email', [EmailController::class, 'welcome']);
	Route::get('emails/review-request', [EmailController::class, 'review']);
});

Route::middleware(['auth'])->group(function () {
	Route::get('logout', [LoginController::class, 'logout']);
});

Route::middleware(['guest'])->group(function () {
	Route::get('login', [LoginController::class, 'login'])->name('login');
	Route::post('login', [LoginController::class, 'authenticate']);
	Route::get('forgot-password', [LoginController::class, 'forgot']);
	Route::post('forgot-password', [LoginController::class, 'reset']);	
});

Route::get('assets/lake-gallery/{gallery}', [AssetController::class, 'gallery']);
Route::get('assets/feature-gallery/{gallery}', [AssetController::class, 'features']);
Route::get('assets/stock/{side}/{stock}', [AssetController::class, 'stock']);
Route::get('assets/catch-reports/{side}/{report}', [AssetController::class, 'report']);
Route::get('assets/stocking/{side}/{fish}', [AssetController::class, 'stocking']);
Route::get('assets/swims/{swim}', [AssetController::class, 'swims']);
Route::get('assets/photo-diary/{photodiary}', [AssetController::class, 'photodiary']);
Route::get('assets/article-cover/{article}', [AssetController::class, 'article']);
Route::get('assets/article-gallery/{articleimage}', [AssetController::class, 'articleimage']);
