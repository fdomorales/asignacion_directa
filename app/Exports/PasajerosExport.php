<?php

namespace App\Exports;

use App\Models\Pasajero;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PasajerosExport implements FromCollection, WithHeadings
{
    protected $viaje_id;
    
    public function __construct($viaje_id){
        $this->viaje_id = $viaje_id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pasajero::select
        ('rut_pasajero', 'nombre_pasajero', 'apellido_paterno_pasajero','apellido_materno_pasajero' , 'fecha_nacimiento_pasajero','sexo_pasajero', 'direccion_pasajero', 'telefono_pasajero')
        ->where('viaje_id', $this->viaje_id)->get();
    }
    
    public function headings(): array
    {
        return ['RUT','Nombre', 'Apellido paterno', 'Apellido materno', 'Fecha de Nacimiento', 'Sexo','Dirección', 'Teléfono'];
    }
}
