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
        Schema::create('estado_periodos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_estado');
            $table->timestamps();
        });
        //datos de prueba
        $data = [
            ['nombre_estado'=>'Habilitado'],
            ['nombre_estado'=>'Deshabilitado']
        ];

        DB::table("estado_periodos")->insert($data);
        //fin datos prueba
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado_periodos');
    }
};
