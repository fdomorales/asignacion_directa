<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Viaje;
use App\Models\Comuna;
use OwenIt\Auditing\Contracts\Auditable;

class Pasajero extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
    public function viaje(){
        return $this->belongsTo(Postulacion::class);
    }
    public function comuna(){
        return $this->belongsTo(Comuna::class);
    }
}
