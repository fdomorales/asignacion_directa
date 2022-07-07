<?php

namespace App\Exports;

use App\Models\Viaje;
use Maatwebsite\Excel\Concerns\FromCollection;

class ViajesExports implements FromCollection
{
    protected $calendario_id;

    public function __construct($calendario_id){
        $this->calendario_id = $calendario_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $viaje = Viaje::select('origen_viaje', 'destino_viaje', 'inicio_viaje', 'fin_viaje')->where('calendario_id','=', $this->calendario_id)->get();
        return $viaje;
    }
}
