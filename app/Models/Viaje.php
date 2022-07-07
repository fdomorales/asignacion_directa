<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Calendario;

class Viaje extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'origen_viaje', 'destino_viaje', 'inicio_viaje', 'fin_viaje', 'estado_viaje', 'calendario_id'
    ];
    
    public function calendarios(){
        return $this->belongsTo(Calendario::class);
    }
}
