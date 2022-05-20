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
            
            $table->bigInteger('region_id')->unsigned();
            $table->foreign('region_id')->references('id')->on('regiones');
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
