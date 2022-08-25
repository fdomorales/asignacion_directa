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
            $table->string('rut_pasajero');
            $table->string('nombre_pasajero');
            $table->string('apellido_paterno_pasajero');
            $table->string('apellido_materno_pasajero');
            $table->date('fecha_nacimiento_pasajero');
            $table->string('sexo_pasajero');
            $table->string('direccion_pasajero');
            $table->string('telefono_pasajero')->nullable();
            $table->string('contacto_pasajero')->nullable();
            $table->string('nombre_doc_ci')->nullable();
            $table->string('ruta_doc_ci')->nullable();
            $table->string('token_doc_ci')->nullable();
            $table->string('hash_doc_ci')->nullable();
            $table->string('nombre_doc_csh')->nullable();
            $table->string('ruta_doc_csh')->nullable();
            $table->string('token_doc_csh')->nullable();
            $table->string('hash_doc_csh')->nullable();
            $table->string('nombre_doc_da')->nullable();
            $table->string('ruta_doc_da')->nullable();
            $table->string('token_doc_da')->nullable();
            $table->string('hash_doc_da')->nullable();
            $table->bigInteger('comuna_id')->unsigned();
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
