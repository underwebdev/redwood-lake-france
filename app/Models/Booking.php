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
        return $this->hasMany(Payment::class)->latest();
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

    public function cancellation()
    {
        return $this->hasOne(Cancellation::class);
    }

    public function voucher()
    {
        return $this->belongsToMany(Voucher::class);
    }

    public function notifications()
    {
        return $this->hasOne(Notification::class);
    }

    public function maillogs()
    {
        return $this->hasMany(BookingMailLog::class)->latest();
    }

    public function extras()
    {
        return $this->hasMany(Extra::class);
    }
}
