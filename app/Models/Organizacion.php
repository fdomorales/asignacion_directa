<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Postulacion;
use App\Models\Comuna;
use App\Models\Representante;
use App\Models\User;
use OwenIt\Auditing\Contracts\Auditable;

class Organizacion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

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
