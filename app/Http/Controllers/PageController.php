<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Page;
use App\Models\Review;
use App\Models\Rule;
use App\Models\Term;
use App\Models\Article;
use App\Models\Photodiary;
use App\Models\Priceguide;
use App\Models\Lake;
use App\Models\Placeholder;
use App\Models\Priceguides;
use App\Models\Booking;
use App\Models\Stock;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;

class PageController extends Controller
{
    public function index()
    {
        $page = Page::find(1);
        $review = Review::where('featured', 1)->first();
        $priceguides = Priceguide::whereNotNull('featured')->get();
        
        $firstdate = Priceguide::where('end', '>', Carbon::today())->pluck('start')->first();
        $latestdate = Priceguide::orderBy('end', 'desc')->pluck('end')->first();

        $bookingdates = Collect(CarbonInterval::days(7)->toPeriod($firstdate, $latestdate));
        $bookingmonths = Collect(CarbonInterval::months(1)->toPeriod($firstdate, $latestdate));
        $bookings = Booking::where('arrival', '>=', $firstdate)->where('arrival', '<=', $latestdate)->get()->pluck('arrival');
        $placeholders = Placeholder::all();

    	return view('pages.index', compact('page', 'review', 'priceguides', 'latestdate', 'bookingdates', 'bookingmonths', 'bookings', 'placeholders'));
    }

    public function lake()
    {
        $page = Page::find(2);

        $lake = Lake::find(1);

        return view('pages.lake', compact('page', 'lake'));
    }

    public function booking()
    {
        $page = Page::find(3);

        $priceguides = Priceguide::whereNotNull('featured')->get();

    	return view('pages.booking', compact('page', 'priceguides'));
    }

    public function bookingterms()
    {
        $page = Page::find(4);

        $terms = Term::all();

        return view('pages.bookingterms', compact('page', 'terms'));
    }

    public function deposit($date)
    {
        $date = Carbon::parse($date)->format('Y-m-d');
        $firstdate = Priceguide::where('end', '>', Carbon::today())->orderBy('start', 'desc')->pluck('start')->first();
        $latestdate = Priceguide::orderBy('end', 'desc')->pluck('end')->first();

        if(Carbon::parse($date)->dayOfWeekIso != 6)
        {
            return redirect('/booking');
        } elseif($date > $latestdate)
        {
            return redirect('/booking');
        }

        $bookingdates = Collect(CarbonInterval::days(7)->toPeriod($firstdate, $latestdate));

        if(Booking::where('arrival', $date)->exists())
        {
            return redirect('/booking')->with('failure', 'Selected date no longer available');
        }

        if(Placeholder::where('date', $date)->exists())
        {
            return redirect('/booking')->with('failure', 'Selected date no longer available');
        }

        return view('pages.deposit', compact('date'));
    }

    public function paymentcomplete()
    {
        return view('pages.paymentcomplete');
    }

    public function reports()
    {
        $page = Page::find(5);

        return view('pages.reports', compact('page'));
    }

    public function stock()
    {
        $page = Page::find(6);

        $stock = Stock::whereNotNull('alive')->get();

        return view('pages.stock', compact('page', 'stock'));
    }

    public function fish(Stock $stock)
    {
        return view('pages.fish', compact('stock'));
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

        $featured = Photodiary::where('is_featured', 1)->first();

        $secondary = Photodiary::where('is_featured', 2)->first();

        $photos = Photodiary::where('id', '!=', $featured->id)->where('id', '!=', $secondary->id)->orderBy('date', 'desc')->paginate(60);

        return view('pages.diary', compact('page', 'featured', 'secondary', 'photos'));        
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
}
