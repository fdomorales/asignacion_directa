<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_postulaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_estado_postulacion');
            $table->string('descripcion_estado_postulacion');
            $table->timestamps();
        });
        //datos de prueba
        $data = [
            ['nombre_estado_postulacion'=>'Aprobado', 'descripcion_estado_postulacion' => ''],
            ['nombre_estado_postulacion'=>'Pendiente', 'descripcion_estado_postulacion' => ''],
            ['nombre_estado_postulacion'=>'Rechazado', 'descripcion_estado_postulacion' => ''],
            ['nombre_estado_postulacion'=>'Aprobado con cupos asignados', 'descripcion_estado_postulacion' => '']
        ];
        DB::table("estado_postulaciones")->insert($data);
        //fin datos prueba
    }
    


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado_postulaciones');
    }
};
