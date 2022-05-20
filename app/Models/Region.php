<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Provincia;
use App\Models\Periodo;

class Region extends Model
{
    use HasFactory;

    
    public function provincia(){
        return $this->hasMany(Provincia::class);
    }
    public function periodo(){
        return $this->hasMany(Periodo::class);
    }
}
