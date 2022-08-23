<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function stocking()
    {
        return $this->belongsTo(Stocking::class);
    }

    public function specimen()
    {
        return $this->belongsTo(Specimen::class);
    }
}
