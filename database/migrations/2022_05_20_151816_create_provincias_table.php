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
        Schema::create('provincias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_provincia');
            $table->string('codigo_provincia');
            $table->string('estado_provincia');
            $table->timestamps();
        });
        //datos de prueba
        /* $data = [
            ['nombre_provincia'=>'Provincia de prueba', 'codigo_provincia'=>' ', 'estado_provincia'=>' ']
        ];
        DB::table("provincias")->insert($data); */
        //fin datos prueba
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provincias');
    }
};
