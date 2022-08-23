<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Page;
use App\Models\Review;
use App\Models\Rule;
use App\Models\Term;
use App\Models\Articles;

class PageController extends Controller
{
    public function index()
    {
        $page = Page::find(1);
        $review = Review::where('featured', 1)->first();

    	return view('pages.index', compact('page', 'review'));
    }

    public function lake()
    {
        $page = Page::find(2);

        return view('pages.lake', compact('page'));
    }

    public function booking()
    {
        $page = Page::find(3);

    	return view('pages.booking', compact('page'));
    }

    public function bookingterms()
    {
        $page = Page::find(4);

        $terms = Term::all();

        return view('pages.bookingterms', compact('page', 'terms'));
    }

    public function deposit()
    {
        return view('pages.deposit');
    }

    public function reports()
    {
        $page = Page::find(5);

        return view('pages.reports', compact('page'));
    }

    public function stock()
    {
        $page = Page::find(6);

        return view('pages.stock', compact('page'));
    }

    public function fish()
    {
        return view('pages.fish');
    }

    public function location()
    {
        $page = Page::find(7);

        return view('pages.location', compact('page'));
    }

    public function facilities()
    {
        $page = Page::find(8);

        return view('pages.facilities', compact('page'));
    }

    public function rules()
    {
        $page = Page::find(9);
        $rules = Rule::all();

		return view('pages.rules', compact('page', 'rules'));    	
    } 

    public function regulations()
    {
        $page = Page::find(10);

        return view('pages.regulations', compact('page'));
    }

    public function news()
    {
        $page = Page::find(11);
        $articles = Article::all();

        return view('pages.news', compact('page', 'articles'));
    }

    public function article()
    {
        return view('pages.article');
    }

    public function diary()
    {
        $page = Page::find(12);

        return view('pages.diary', compact('page'));        
    } 

    

    public function weather()
    {
        $page = Page::find(13);

        $key = '8c4607d2-0a9d-4ead-b87f-830720bd22fc';

        $forecastdata = 'http://datapoint.metoffice.gov.uk/public/data/val/wxfcs/all/json/353207?res=3hourly&key='.$key;
        $forecastalt = 'http://datapoint.metoffice.gov.uk/public/data/val/wxobs/all/json/3672?res=hourly&key='.$key;

        $client = new \GuzzleHttp\Client();
        $res = $client->get($forecastdata);

        if ($res->getStatusCode() == 200) {
          $j = $res->getBody();
          $weathernew = preg_replace('/\$/', 'mpm', $j);
          $obj = json_decode($weathernew);
          $forecast = $obj;
        }

        return view('pages.weather', ['forecast' => $forecast, 'page' => $page]);
    } 

    public function contact()
    {
        $page = Page::find(14);

 		return view('pages.contact', compact('page'));   	
    }

    public function terms()
    {
        $page = Page::find(15);

        return view('pages.terms', compact('page'));
    }

    public function privacy()
    {
        $page = Page::find(16);

        return view('pages.privacy', compact('page'));        
    }

    public function covid()
    {
        $page = Page::find(17);

        return view('pages.covid', compact('page'));
    }
}
