<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Viaje;

class Pasajero extends Model
{
    use HasFactory;

    
    public function viaje(){
        return $this->belongsTo(Postulacion::class);
    }
}
