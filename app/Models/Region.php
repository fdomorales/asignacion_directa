<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Provincia;
use App\Models\Periodo;
use App\Models\Postulacion;

class Region extends Model
{
    use HasFactory;
    protected $table = 'regiones';
    
    public function provincia(){
        return $this->hasMany(Provincia::class);
    }
    public function periodo(){
        return $this->belongsToMany(Periodo::class);
    }
    public function postulacion(){
        return $this->hasMany(Postulacion::class);
    }
}
