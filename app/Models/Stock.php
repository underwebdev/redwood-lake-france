<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function specimen()
    {
        return $this->belongsTo(Specimen::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
