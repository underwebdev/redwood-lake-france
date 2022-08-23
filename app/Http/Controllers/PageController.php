<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $page = Page::find(1);

    	return view('pages.index', compact('page'));
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

        return view('pages.weather', ['forecast' => $forecast]);
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
