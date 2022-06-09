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
        Schema::table('periodos', function (Blueprint $table) {
            
            $table->bigInteger('tipo_periodos_id')->unsigned();
            $table->foreign('tipo_periodos_id')->references('id')->on('tipo_periodos');
        
        });

        Schema::table('comunas', function (Blueprint $table) {            

            $table->bigInteger('provincia_id')->unsigned();
            $table->foreign('provincia_id')->references('id')->on('provincias');  

        });
        
        Schema::table('provincias', function (Blueprint $table) {            

            $table->bigInteger('region_id')->unsigned();
            $table->foreign('region_id')->references('id')->on('regiones');  
                  
        });

        Schema::table('postulaciones', function (Blueprint $table) {            

            $table->foreign('estado_postulacion_id')->references('id')->on('estado_postulaciones');  
            $table->foreign('comuna_id')->references('id')->on('comunas');  
            $table->foreign('periodo_id')->references('id')->on('periodos');  
            $table->foreign('organizacion_id')->references('id')->on('organizaciones');  

                  
        });
        Schema::table('periodo_region', function (Blueprint $table) {
            
            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');;
            $table->foreign('region_id')->references('id')->on('regiones');
                  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
