<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class EndpointController extends Controller
{
    public function handle()
    {
        $reports = Report::with(['angler', 'specimen', 'swim'])->get();

        $data = $reports->toJson();

        return view('pages.api', compact('data'));
    }
}
