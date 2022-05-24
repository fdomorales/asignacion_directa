<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\EstadoPeriodo;

class Periodo extends Model
{
    use HasFactory;

    public function region(){
        return $this->belongsTo(Region::class);
    }
    public function estado_periodos(){
        return $this->belongsTo(EstadoPeriodo::class);
    }
}
