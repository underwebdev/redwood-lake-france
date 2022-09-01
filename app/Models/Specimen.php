<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specimen extends Model
{
    use HasFactory;

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
