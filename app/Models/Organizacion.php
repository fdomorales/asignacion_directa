<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Postulacion;
use App\Models\Comuna;
use App\Models\Representante;
use App\Models\User;


class Organizacion extends Model
{
    use HasFactory;
    protected $table = 'organizaciones';

    public function postulacion(){
        return $this->hasMany(Postulacion::class);
    }
    public function comuna(){
        return $this->belongsTo(Comuna::class);
    }
    public function representante(){
        return $this->hasMany(Representante::class);
    }
    public function usuario(){
        return $this->belongsTo(User::class);
    }
}
