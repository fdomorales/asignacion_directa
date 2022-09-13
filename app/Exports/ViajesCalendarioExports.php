<?php

namespace App\Exports;

use App\Models\Viaje;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ViajesCalendarioExports implements FromCollection, WithHeadings
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
        $viaje = Viaje::select('origen_viaje', 'destino_viaje', 'inicio_viaje', 'fin_viaje', 
        'periodo_viaje', 'cupo_baja_viaje', 'temporada_viaje', 'copago_viaje')->where('calendario_id','=', $this->calendario_id)->get();
        return $viaje;
    }

    public function headings(): array
    {
        return ['Origen', 'Destino', 'Fecha Inicio', 'Fecha Fin', 'Periodo', 'Cupo', 'Temporada', 'Copago'];
    }
}
