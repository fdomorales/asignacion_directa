<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EstadoPostulacion;
use App\Models\Region;
use App\Models\Periodo;
use App\Models\Organizacion;

class Postulacion extends Model
{
    protected $table = 'postulaciones';
    use HasFactory;

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
}
