<?php

namespace App\Exports;

use App\Models\Pasajero;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ViajesPasajerosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pasajero::join('viajes', 'pasajeros.viaje_id', '=', 'viajes.id')
        ->select('viajes.id', 'viajes.origen_viaje', 'viajes.destino_viaje', 'viajes.inicio_viaje', 'viajes.fin_viaje'
        , 'viajes.periodo_viaje','viajes.temporada_viaje', 'pasajeros.rut_pasajero', 'pasajeros.nombre_pasajero'
        , 'pasajeros.apellido_paterno_pasajero', 'pasajeros.apellido_materno_pasajero', 'pasajeros.sexo_pasajero', 'pasajeros.direccion_pasajero', 'pasajeros.telefono_pasajero')
        ->get();

  
    }

    public function headings(): array
    {
        return ['N° viaje', 'Origen', 'Destino', 'Fecha Inicio', 'Fecha Término', 'Periodo', 'Temporada', 'Rut', 'Nombres', 'Apellido paterno',
    'Apeliido materno', 'Sexo', 'Dirección', 'Teléfono'];
    }
}
