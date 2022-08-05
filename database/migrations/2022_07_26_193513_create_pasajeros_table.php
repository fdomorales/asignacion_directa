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
        Schema::create('pasajeros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_pasajero');
            $table->string('apellido_pasajero');
            $table->date('fecha_nacimiento_pasajero');
            $table->string('direccion_pasajero');
            $table->string('telefono_pasajero');
            $table->string('contacto_pasajero');
            $table->bigInteger('viaje_id')->unsigned();
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
        Schema::dropIfExists('pasajeros');
    }
};
