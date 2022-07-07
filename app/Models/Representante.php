<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organizacion;

class Representante extends Model
{
    use HasFactory;

    protected $table = 'representantes';

    public function organizacion(){
        return $this->belongsTo(Organizacion::class);
    }
}
