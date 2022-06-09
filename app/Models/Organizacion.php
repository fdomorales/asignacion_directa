<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Postulacion;


class Organizacion extends Model
{
    use HasFactory;
    protected $table = 'organizaciones';

    public function postulacion(){
        return $this->hasMany(Postulacion::class);
    }
}
