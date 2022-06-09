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
        Schema::create('regiones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_region');
            $table->string('codigo_region');
            $table->string('estado_region');
            $table->timestamps();
        });
        
        //datos de prueba
        $data = [
            ['nombre_region'=>'Metropolitana', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Arica', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Atacama', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Coquimbo', 'codigo_region'=>'', 'estado_region'=>'']
        ];
        DB::table("regiones")->insert($data);
        //fin datos prueba
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regiones');
    }
};
