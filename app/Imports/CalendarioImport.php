<?php

namespace App\Imports;

use App\Models\Viaje;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CalendarioImport implements ToModel, WithStartRow
{
    protected $calendario_id;
    protected $estado_viaje;
    protected $viaje_asignado;

    public function __construct($calendario_id){
        $this->calendario_id = $calendario_id;
        $this->estado_viaje = 1;
        $this->viaje_asignado = false;
    }
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $format_insert = 'Y-m-d';
        return new Viaje([
            'origen_viaje'=>$row[0],
            'destino_viaje'=>$row[1],
            'inicio_viaje'=>$this->convertDate($row[2], $format_insert),
            'fin_viaje'=>$this->convertDate($row[3], $format_insert),
            'periodo_viaje'=>$row[4],
            'cupo_baja_viaje'=>$row[5],
            'temporada_viaje'=>$row[6],
            'copago_viaje'=>$row[7],
            'estado_viaje'=> $this->estado_viaje,
            'viaje_asignado'=> $this->viaje_asignado,
            'calendario_id'=>$this->calendario_id,

        ]);

        
    }
    public function convertDate($dateValue, $format = "d-m-Y"){
        $unixDate = ($dateValue - 25569) * 86400;
        return gmdate($format, $unixDate);
    }
    //otra forma de cambiar el formato de fecha
    /* public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    } */
    // otra forma de ignorar primera fila, usar WithHeadingRow
    /* public function model(array $row)
    {
        return new Calendario([
            'origen'=>$row['origen'],
            'destino'=>$row['destino'],
        ]);
    } */
}
