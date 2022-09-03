<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function angler()
    {
        return $this->belongsTo(Angler::class);
    }

    public function paymethod()
    {
        return $this->belongsTo(Paymethod::class);
    }
}


