<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Postulacion;

class EstadoPostulacion extends Model
{
    use HasFactory;
    protected $table = 'estado_postulaciones';

    public function postulacion(){
        return $this->hasMany(Postulacion::class);
    }
}
