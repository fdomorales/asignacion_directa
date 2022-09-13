<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organizacion;
use OwenIt\Auditing\Contracts\Auditable;

class Representante extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'representantes';

    public function organizacion(){
        return $this->belongsTo(Organizacion::class);
    }
}
