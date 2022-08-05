<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organizacion;
use App\Models\Provincia;

class Comuna extends Model
{
    use HasFactory;
    protected $table = 'comunas';
    
    public function organizacion(){
        return $this->hasMany(Organizacion::class);
    }
    public function provincia(){
        return $this->belongsTo(Provincia::class);
    }
}
