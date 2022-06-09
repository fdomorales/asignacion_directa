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
        Schema::create('organizaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_organizacion');
            $table->string('correo_organizacion');
            $table->bigInteger('comuna_id')->unsigned();
            $table->timestamps();
        });
        //datos de prueba
        /* $data = [
            ['nombre_organizacion'=>'Organización de prueba', 'correo_organizacion'=> 'prueba@prueba.cl', 'comuna_id'=>1]
        ];
        DB::table("organizaciones")->insert($data); */
        //fin datos prueba
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizacions');
    }
};
