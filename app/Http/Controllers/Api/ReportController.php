<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Http\Resources\PriceResource;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Priceguide;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return ReportResource::collection(Report::with('specimen')->where('lbs', '>', '15')->orderBy('date', 'desc')->get());
    }

    public function priceguide()
    {
        return PriceResource::collection(Priceguide::whereNotNull('featured')->where('end', '>', Carbon::now()->toDateString())->orderBy('start', 'asc')->get());
    }
}
