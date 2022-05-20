<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Provincia;

class Region extends Model
{
    use HasFactory;

    
    public function provincia(){
        return $this->hasMany(Provincia::class);
    }
}
