<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function angler()
    {
        return $this->belongsTo(Angler::class);
    }

    public function specimen()
    {
        return $this->belongsTo(Specimen::class);
    }

    public function swim()
    {
        return $this->belongsTo(Swim::class);
    }

    public function stock()
    {
        return $this->belongsTo(Report::class);
    }
}
