<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Calendario;
use App\Models\Postulacion;
use App\Models\Pasajero;

class Viaje extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'origen_viaje', 'destino_viaje', 'inicio_viaje', 'fin_viaje', 'estado_viaje', 'viaje_asignado', 'calendario_id', 'postulacion_id'
    ];
    
    public function calendarios(){
        return $this->belongsTo(Calendario::class, 'calendario_id', 'id');
    }
    public function postulacion(){
        return $this->belongsTo(Postulacion::class);
    }
    public function pasajeros(){
        return $this->hasMany(Pasajero::class);
    }
}
