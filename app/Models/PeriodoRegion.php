<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Periodo;
use App\Models\Region;
use OwenIt\Auditing\Contracts\Auditable;

class PeriodoRegion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'periodo_region';

    public function periodo(){
        return $this->belongsTo(Periodo::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }
}
