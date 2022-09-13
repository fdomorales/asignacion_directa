<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Viaje;
use App\Models\Periodo;
use OwenIt\Auditing\Contracts\Auditable;

class Calendario extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
    public function periodo(){
        return $this->belongsTo(Periodo::class);
    }
    public function viajes(){
        return $this->hasMany(Viaje::class, 'calendario_id', 'id');
    }
}
