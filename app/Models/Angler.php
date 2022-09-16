<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angler extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->latest();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function parties()
    {
        return $this->belongsToMany(Booking::class);
    }
    
}
