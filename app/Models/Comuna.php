<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organizacion;

class Comuna extends Model
{
    use HasFactory;
    protected $table = 'comunas';
    
    public function organizacion(){
        return $this->hasMany(Organizacion::class);
    }
}
