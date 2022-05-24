<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;

class Periodo extends Model
{
    use HasFactory;

    public function regiones(){
        return $this->belongsTo(Region::class);
    }
}
