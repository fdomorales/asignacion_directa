<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Calendario;
use App\Models\Postulacion;
use App\Models\Pasajero;
use OwenIt\Auditing\Contracts\Auditable;
use Carbon\Carbon;

class Viaje extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
    protected $fillable = [
        'origen_viaje', 'destino_viaje', 'inicio_viaje', 'fin_viaje', 'periodo_viaje', 'cupo_baja_viaje', 'temporada_viaje', 'copago_viaje','estado_viaje', 'viaje_asignado', 'calendario_id', 'postulacion_id'
    ];
    
    public function calendarios(){
        return $this->belongsTo(Calendario::class, 'calendario_id', 'id');
    }
    public function postulacion(){
        return $this->belongsTo(Postulacion::class)->withDefault();
    }
    public function pasajeros(){
        return $this->hasMany(Pasajero::class);
    }

    // Agregado por aiturra
    public static function getIdViajeByViajeAndUser($idViaje) {
        return Viaje::query()
            ->where('id',$idViaje)
            ->where('viaje_asignado',1)
            // ->whereIn('estado_viaje', [1,2,3,4,...])
            ->whereHas('postulacion.organizacion', function($q) {
                $q->where('user_id',auth()->user()->id);
            })
            ->value('id');
    }

    // Agregado por aiturra
    public static function getCantidadViajesPeriodo($periodoId) {
        return Viaje::query()
            ->whereHas('calendarios', function($q) use($periodoId) {
                $q->where('periodo_id', $periodoId);
            })
            ->whereHas('postulacion.organizacion', function($q) {
                $q->where('user_id', auth()->user()->id);
            })
            ->where('viaje_asignado', 1)
            ->count();
    }
}
