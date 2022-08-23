<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lake extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function swims()
    {
        return $this->hasMany(Swim::class);
    }
}
