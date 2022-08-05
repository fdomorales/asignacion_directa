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
            
            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');
            $table->foreign('region_id')->references('id')->on('regiones');
                  
        });
        Schema::table('organizaciones', function (Blueprint $table) {
            
            $table->foreign('comuna_id')->references('id')->on('comunas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
                  
        });
        Schema::table('calendarios', function (Blueprint $table) {
            
            $table->foreign('periodo_id')->references('id')->on('periodos');
                  
        });
        Schema::table('viajes', function (Blueprint $table) {
            
            $table->foreign('calendario_id')->references('id')->on('calendarios');
            $table->foreign('postulacion_id')->references('id')->on('postulaciones');
                  
        });
        Schema::table('pasajeros', function (Blueprint $table) {
            
            $table->foreign('viaje_id')->references('id')->on('viajes');
                  
        });
        //datos de prueba
        $data_regiones = [
            ['nombre_region'=>'Metropolitana', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Arica', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Atacama', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Coquimbo', 'codigo_region'=>'', 'estado_region'=>'']
        ];
        DB::table("regiones")->insert($data_regiones);
        $data_provincias = [
            ['nombre_provincia'=>'Provincia de prueba111', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => '1'],
            ['nombre_provincia'=>'Provincia de prueba222', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => '2']
        ];
        DB::table("provincias")->insert($data_provincias);
        $data_comunas = [
            ['nombre_comuna'=>'Comuna de prueba111', 'alias_comuna'=>'alias 1', 'codigo_comuna'=>'', 'estado_comuna'=>'', 'provincia_id'=>'1'],
            ['nombre_comuna'=>'Comuna de prueba222', 'alias_comuna'=>'alias 2', 'codigo_comuna'=>'', 'estado_comuna'=>'', 'provincia_id'=>'2']
        ];
        DB::table("comunas")->insert($data_comunas);
        //fin datos prueba
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
