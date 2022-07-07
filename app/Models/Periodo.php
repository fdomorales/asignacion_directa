<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\EstadoPeriodo;
use App\Models\Postulacion;
use App\Models\TipoPeriodo;
use App\Models\Calendario;

class Periodo extends Model
{
    use HasFactory;

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
}
