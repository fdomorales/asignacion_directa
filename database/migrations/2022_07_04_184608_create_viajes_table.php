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
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->string('origen_viaje');
            $table->string('destino_viaje');
            $table->date('inicio_viaje');
            $table->date('fin_viaje');
            $table->string('estado_viaje');
            $table->bigInteger('calendario_id')->unsigned();
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
        Schema::dropIfExists('viajes');
    }
};
