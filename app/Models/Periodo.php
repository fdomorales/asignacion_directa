<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\PeriodoRegion;
use App\Models\EstadoPeriodo;
use App\Models\Postulacion;
use App\Models\TipoPeriodo;
use App\Models\Calendario;
use OwenIt\Auditing\Contracts\Auditable;

class Periodo extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public function region(){
        return $this->belongsToMany(Region::class);
    }
    public function estado_periodos(){
        return $this->belongsTo(EstadoPeriodo::class);
    }
    public function postulacion(){
        return $this->hasMany(Postulacion::class);
    }
    public function tipo_periodos(){
        return $this->belongsTo(TipoPeriodo::class);
    }
    public function calendario(){
        return $this->hasOne(Calendario::class);
    }

    public function regiones_periodo(){
        return $this->hasMany(PeriodoRegion::class);
    }

    // Agregado por aiturra
    public static function getIdPeriodoActivo() {
        $regionUsuario = auth()->user()->organizacion->comuna->provincia->region_id;

        $periodo = Periodo::query()
            ->where('estado_periodos_id', 1)
            ->whereDate('fecha_inicio', '<=', date('Y-m-d'))
            //TODO: Probar funcionamiento cuando sea modificado el formato de fecha_ini
            //->whereTime('fecha_inicio', '<=', date('Y-m-d H:i:s'))
            ->whereDate('fecha_fin', '>=', date('Y-m-d'))
            //TODO: Probar funcionamiento cuando sea modificado el formato de fecha_fin
            //->whereTime('fecha_fin', '>=', date('Y-m-d H:i:s'))
            ->whereHas('regiones_periodo', function ($q) use($regionUsuario) {
                $q->where('region_id', '=', $regionUsuario);
            })
            ->first();

        return !is_null($periodo) ? $periodo->value('id') : null;
    }

    public static function getIdPeriodoActivoByUser() {
        $regionUsuario = auth()->user()->organizacion->comuna->provincia->region_id;

        $periodo = Periodo::query()
            ->where('estado_periodos_id', 1)
            ->whereDate('fecha_inicio', '<=', date('Y-m-d'))
            //TODO: Probar funcionamiento cuando sea modificado el formato de fecha_ini
            //->whereTime('fecha_inicio', '<=', date('Y-m-d H:i:s'))
            ->whereDate('fecha_fin', '>=', date('Y-m-d'))
            //TODO: Probar funcionamiento cuando sea modificado el formato de fecha_fin
            //->whereTime('fecha_fin', '>=', date('Y-m-d H:i:s'))
            ->whereHas('regiones_periodo', function ($q) use($regionUsuario) {
                $q->where('region_id', '=', $regionUsuario);
            })
            ->whereHas('postulacion.organizacion', function ($q) {
                $q->where('user_id', '=', auth()->user()->id);
            })
            ->first();

        return !is_null($periodo) ? $periodo->value('id') : null;
    }

    public static function getIdPeriodoByViajeAndUser($viajeId) {
        $periodo = Periodo::query()
            ->whereHas('calendario.viajes', function ($q) use($viajeId) {
                $q->where('id',$viajeId);
            })
            ->whereHas('postulacion.organizacion', function ($q) {
                $q->where('user_id', '=', auth()->user()->id);
            })
            ->first();

        return !is_null($periodo) ? $periodo->value('id') : null;
    }
}
