<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Viaje;
use App\Models\Comuna;

class Pasajero extends Model
{
    use HasFactory;

    
    public function viaje(){
        return $this->belongsTo(Postulacion::class);
    }
    public function comuna(){
        return $this->belongsTo(Comuna::class);
    }
}
