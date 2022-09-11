<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function angler()
    {
        return $this->belongsTo(Angler::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function priceguide()
    {
        return $this->belongsTo(Priceguide::class);
    }

    public function contact()
    {
        return $this->hasMany(Contact::class);
    }

    public function guests()
    {
        return $this->belongsToMany(Angler::class);
    }
}
