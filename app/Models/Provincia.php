<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comuna;
use App\Models\Region;

class Provincia extends Model
{
    use HasFactory;

    public function comuna(){
        return $this->hasMany(Comuna::class);
    }
    public function region(){
        return $this->belongsTo(Region::class);
    }
}
