<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EstadoPostulacion;
use App\Models\Region;
use App\Models\Periodo;
use App\Models\Organizacion;
use App\Models\Viaje;
use OwenIt\Auditing\Contracts\Auditable;

class Postulacion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'postulaciones';

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function estado_postulacion(){
        return $this->belongsTo(EstadoPostulacion::class);
    }
    public function organizacion(){
        return $this->belongsTo(Organizacion::class);
    }
    public function periodo(){
        return $this->belongsTo(Periodo::class);
    }
    public function viaje(){
        return $this->hasMany(Viaje::class);
    }

    // Agregado por aiturra
    public static function getPostulacionByPeriodoId($periodoId) {
        return Postulacion::query()
            ->with('organizacion', function ($q) {
                $q->firstWhere('user_id', '=', auth()->user()->id);
            })
            ->firstWhere('periodo_id', $periodoId);
    }
}
