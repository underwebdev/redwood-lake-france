<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swim extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function lake()
    {
        return $this->belongsTo(Lake::class);
    }
}
