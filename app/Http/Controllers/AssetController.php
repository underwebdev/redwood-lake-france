<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Fishgallery;
use App\Models\Stock;
use App\Models\Report;
use App\Models\Item;

class AssetController extends Controller
{
    public function gallery(Fishgallery $gallery)
    {
        $path = 'public/'  . Str::after($gallery->thumbnail, '/storage/');

        return $this->asset($path);
    }

    public function stock($side, Stock $stock)
    {
        $photo = $stock->{$side}; // side1 or side2
    
        $path = 'public/' . Str::after($photo, '/storage/');
        

        return $this->asset($path);
    }

    public function report($side, Report $report)
    {
        $photo = $report->{$side . 'thumb'}; // side1 or side2

        $path = 'public/' . Str::after($photo, '/storage/');

        return $this->asset($path);
    }

    public function stocking($side, Item $fish)
    {
        $photo = $fish->{$side}; // side1 or side2

        $path = 'public/' . Str::after($photo, '/storage/');

        return $this->asset($path);
    }

    public function asset($path)
    {
        return Storage::disk('s3')->response($path, null, [
            'Content-Disposition' => 'inline',
            'Cache-Control' => 'private, max-age=300',
        ]);
    }

}
