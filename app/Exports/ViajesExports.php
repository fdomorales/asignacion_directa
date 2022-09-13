<?php

namespace App\Exports;

use App\Models\Viaje;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ViajesExports implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $viaje = Viaje::select('origen_viaje', 'destino_viaje', 'inicio_viaje', 'fin_viaje', 
        'periodo_viaje', 'cupo_baja_viaje', 'temporada_viaje', 'copago_viaje')->get();
        return $viaje;
    }

    public function headings(): array
    {
        return ['Origen', 'Destino', 'Fecha Inicio', 'Fecha Fin', 'Periodo', 'Cupo', 'Temporada', 'Copago'];
    }
}
