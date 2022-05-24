<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Periodo;

class TipoPeriodo extends Model
{
    use HasFactory;
    public function periodo(){
        return $this->hasMany(Periodo::class, 'tipo_periodos_id', 'id');
    }
}
