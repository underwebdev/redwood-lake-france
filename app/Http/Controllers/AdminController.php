<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function bookings()
    {
        return view('admin.bookings');
    }

    public function booking()
    {
        return view('admin.booking');
    }

    public function anglers()
    {
        return view('admin.anglers');
    }

    public function catchreport()
    {
        return view('admin.catchreport');
    }

    public function stock()
    {
        return view('admin.stock');
    }

    public function fish()
    {
        return view('admin.fish');
    }

    public function stockdiary()
    {
        return view('admin.stockdiary');
    }

    public function lake()
    {
        return view('admin.lake');
    }

    public function news()
    {
        return view('admin.news');
    }

    public function article(Article $article)
    {
        return view('admin.article', compact('article'));
    }

    public function photodiary()
    {
        return view('admin.photodiary');
    }

    public function content()
    {
        return view('admin.content');
    }

    public function rules()
    {
        return view('admin.rules');
    }

    public function terms()
    {
        return view('admin.terms');
    }

    public function reviews()
    {
        return view('admin.reviews');
    }

    public function pricing()
    {
        return view('admin.pricing');
    }

    public function payments()
    {
        return view('admin.payments');
    }

    public function payouts()
    {
        return view('admin.payouts');
    }

    public function discounts()
    {
        return view('admin.discount');
    }

    public function financial()
    {
        return view('admin.financial');
    }

    public function mailshot()
    {
        return view('admin.mailshot');
    }

    public function inbox()
    {
        return view('admin.inbox');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function storage()
    {
        return view('admin.storage');
    }
}
