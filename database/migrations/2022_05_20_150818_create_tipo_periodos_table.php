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
        Schema::create('tipo_periodos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_tipo_periodo');
            $table->string('descripcion_tipo_periodo');
            $table->timestamps();
        });
        //datos de prueba
        $data = [
            ['nombre_tipo_periodo'=>'Nacional', 'descripcion_tipo_periodo'=>''],
            ['nombre_tipo_periodo'=>'Regional', 'descripcion_tipo_periodo'=>'']
        ];
        DB::table("tipo_periodos")->insert($data);
        //fin datos prueba
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_periodos');
    }
};
