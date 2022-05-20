<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comuna;

class Provincia extends Model
{
    use HasFactory;

    public function comuna(){
        return $this->hasMany(Comuna::class);
    }
}
