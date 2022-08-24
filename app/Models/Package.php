<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function breakdowns()
    {
        return $this->hasMany(Breakdown::class);
    }

    public function priceguides()
    {
        return $this->hasMany(Priceguide::class);
    }
}
