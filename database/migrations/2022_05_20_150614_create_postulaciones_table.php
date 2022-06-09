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
        Schema::create('postulaciones', function (Blueprint $table) {
            $table->id();
            $table->string('cupos');
            $table->boolean('recibe_info');
            $table->string('nombre_documento');
            $table->string('ruta_documento');
            $table->string('token_documento');
            $table->string('hash_documento');
            $table->bigInteger('estado_postulacion_id')->unsigned();
            $table->bigInteger('comuna_id')->unsigned();
            $table->bigInteger('periodo_id')->unsigned();
            $table->bigInteger('organizacion_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postulaciones');
    }
};
