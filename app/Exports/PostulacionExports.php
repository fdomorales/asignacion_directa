<?php

namespace App\Exports;

use App\Models\Postulacion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostulacionExports implements FromCollection, WithHeadings
{
    protected $postulacion_id;

    public function __construct($postulacion_id){
        $this->postulacion_id = $postulacion_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $postulacion = Postulacion::join('organizaciones', 'postulaciones.organizacion_id', '=', 'organizaciones.id')
        ->join('comunas', 'postulaciones.comuna_id', '=', 'comunas.id')
        ->select(
            'organizaciones.nombre_organizacion', 
            'organizaciones.correo_organizacion', 
            'organizaciones.telefono_organizacion',
            'postulaciones.cupos', 
            'comunas.nombre_comuna',
            'postulaciones.created_at')
        ->where('postulaciones.id', '=', $this->postulacion_id)->get();
        return $postulacion;
    }

    public function headings(): array
    {
        return ['Nombre Organización', 'Correo', 'Teléfono', 'Cupos', 'Comuna', 'Fecha de cración'];
    }
}
