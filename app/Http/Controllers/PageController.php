<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
    	return view('pages.index');
    }

    public function booking()
    {
    	return view('pages.booking');
    }

    public function bookingterms()
    {
        return view('pages.bookingterms');
    }

    public function deposit()
    {
        return view('pages.deposit');
    }

    public function lake()
    {
    	return view('pages.lake');
    }

    public function stock()
    {
        return view('pages.stock');
    }

    public function fish()
    {
        return view('pages.fish');
    }

    public function reports()
    {
    	return view('pages.reports');
    }

    public function rules()
    {
		return view('pages.rules');    	
    } 

    public function facilities()
    {
		return view('pages.facilities');
    }

    public function news()
    {
        return view('pages.news');
    }

    public function article()
    {
        return view('pages.article');
    }

    public function diary()
    {
        return view('pages.diary');        
    } 

    public function location()
    {
		return view('pages.location');
    }

    public function weather()
    {
        return view('pages.weather');
    } 

    public function contact()
    {
 		return view('pages.contact');   	
    }

    public function regulations()
    {
        return view('pages.regulations');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function privacy()
    {
        return view('pages.privacy');        
    }

    public function covid()
    {
        return view('pages.covid');
    }
}
