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

        Schema::table('postulaciones', function (Blueprint $table) {

            $table->foreign('estado_postulacion_id')->references('id')->on('estado_postulaciones');
            $table->foreign('comuna_id')->references('id')->on('comunas');
            $table->foreign('periodo_id')->references('id')->on('periodos');
            $table->foreign('organizacion_id')->references('id')->on('organizaciones');


        });
        Schema::table('periodo_region', function (Blueprint $table) {

            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');
            $table->foreign('region_id')->references('id')->on('regiones');

        });
        Schema::table('organizaciones', function (Blueprint $table) {

            $table->foreign('comuna_id')->references('id')->on('comunas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');

        });
        Schema::table('calendarios', function (Blueprint $table) {

            $table->foreign('periodo_id')->references('id')->on('periodos');

        });
        Schema::table('representantes', function (Blueprint $table) {

            $table->foreign('organizacion_id')->references('id')->on('organizaciones');

        });
        Schema::table('viajes', function (Blueprint $table) {

            $table->foreign('calendario_id')->references('id')->on('calendarios');
            $table->foreign('postulacion_id')->references('id')->on('postulaciones');

        });
        Schema::table('pasajeros', function (Blueprint $table) {

            $table->foreign('comuna_id')->references('id')->on('comunas');
            $table->foreign('viaje_id')->references('id')->on('viajes');

        });
        //datos de prueba
        $data_regiones = [
            ['nombre_region'=>'Región de Arica y Parinacota', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Región de Tarapacá', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Región de Antofagasta', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Región de Atacama', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Región de Coquimbo', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Región de Valparaíso', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Región del Libertador General Bernardo OHiggins', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Región del Maule', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Región de Ñuble', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Región del Biobío', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Región de La Araucanía', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Región de Los Ríos', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Región de Los Lagos', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Región Aysén del General Carlos Ibáñez del Campo', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Región de Magallanes y de la Antártica Chilena', 'codigo_region'=>'', 'estado_region'=>''],
            ['nombre_region'=>'Región Metropolitana de Santiago', 'codigo_region'=>'', 'estado_region'=>'']
        ];
        DB::table("regiones")->insert($data_regiones);
        $data_provincias = [
            ['nombre_provincia'=>'Arica', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 1],
            ['nombre_provincia'=>'Parinacota', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 1],
            ['nombre_provincia'=>'Iquique', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 2],
            ['nombre_provincia'=>'Tamarugal', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 2],
            ['nombre_provincia'=>'Antofagasta', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 3],
            ['nombre_provincia'=>'El Loa', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 3],
            ['nombre_provincia'=>'Tocopilla', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 3],
            ['nombre_provincia'=>'Copiapó', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 4],
            ['nombre_provincia'=>'Chañaral', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 4],
            ['nombre_provincia'=>'Huasco', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 4],
            ['nombre_provincia'=>'Elqui', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 5],
            ['nombre_provincia'=>'Choapa', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 5],
            ['nombre_provincia'=>'Limarí', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 5],
            ['nombre_provincia'=>'Valparaíso', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 6],
            ['nombre_provincia'=>'Isla de Pascua', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 6],
            ['nombre_provincia'=>'Los Andes', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 6],
            ['nombre_provincia'=>'Petorca', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 6],
            ['nombre_provincia'=>'Quillota', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 6],
            ['nombre_provincia'=>'San Antonio', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 6],
            ['nombre_provincia'=>'San Felipe de Aconcagua', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 6],
            ['nombre_provincia'=>'Marga Marga', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 6],
            ['nombre_provincia'=>'Cachapoal', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 7],
            ['nombre_provincia'=>'Cardenal Caro', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 7],
            ['nombre_provincia'=>'Colchagua', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 7],
            ['nombre_provincia'=>'Talca', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 8],
            ['nombre_provincia'=>'Cauquenes', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 8],
            ['nombre_provincia'=>'Curicó', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 8],
            ['nombre_provincia'=>'Linares', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 8],
            ['nombre_provincia'=>'Punilla', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 9],
            ['nombre_provincia'=>'Diguillín', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 9],
            ['nombre_provincia'=>'Itata', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 9],
            ['nombre_provincia'=>'Concepción', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 10],
            ['nombre_provincia'=>'Arauco', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 10],
            ['nombre_provincia'=>'Biobío', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 10],
            ['nombre_provincia'=>'Cautín', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 11],
            ['nombre_provincia'=>'Malleco', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 11],
            ['nombre_provincia'=>'Valdivia', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 12],
            ['nombre_provincia'=>'Ranco', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 12],
            ['nombre_provincia'=>'Llanquihue', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 13],
            ['nombre_provincia'=>'Chiloé', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 13],
            ['nombre_provincia'=>'Osorno', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 13],
            ['nombre_provincia'=>'Palena', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 13],
            ['nombre_provincia'=>'Coyhaique', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 14],
            ['nombre_provincia'=>'Aysén', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 14],
            ['nombre_provincia'=>'Capitán Prat', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 14],
            ['nombre_provincia'=>'General Carrera', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 14],
            ['nombre_provincia'=>'Magallanes', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 15],
            ['nombre_provincia'=>'Antártica Chilena', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 15],
            ['nombre_provincia'=>'Tierra del Fuego', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 15],
            ['nombre_provincia'=>'Última Esperanza', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 15],
            ['nombre_provincia'=>'Santiago', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 16],
            ['nombre_provincia'=>'Cordillera', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 16],
            ['nombre_provincia'=>'Chacabuco', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 16],
            ['nombre_provincia'=>'Maipo', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 16],
            ['nombre_provincia'=>'Melipilla', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 16],
            ['nombre_provincia'=>'Talagante', 'codigo_provincia'=>' ', 'estado_provincia'=>' ', 'region_id' => 16]
        ];
        DB::table("provincias")->insert($data_provincias);
        $data_comunas = [
            ['nombre_comuna'=>'Arica', 'alias_comuna'=>'Arica', 'codigo_comuna'=>'15101', 'estado_comuna'=>'', 'provincia_id'=>1],
            ['nombre_comuna'=>'Camarones', 'alias_comuna'=>'Camarones', 'codigo_comuna'=>'15102', 'estado_comuna'=>'', 'provincia_id'=>1],
            ['nombre_comuna'=>'Putre', 'alias_comuna'=>'Putre', 'codigo_comuna'=>'15201', 'estado_comuna'=>'', 'provincia_id'=>2],
            ['nombre_comuna'=>'General Lagos', 'alias_comuna'=>'General Lagos', 'codigo_comuna'=>'15202', 'estado_comuna'=>'', 'provincia_id'=>2],
            ['nombre_comuna'=>'Iquique', 'alias_comuna'=>'Iquique', 'codigo_comuna'=>'1101', 'estado_comuna'=>'', 'provincia_id'=>3],
            ['nombre_comuna'=>'Alto Hospicio', 'alias_comuna'=>'Alto Hospicio', 'codigo_comuna'=>'1107', 'estado_comuna'=>'', 'provincia_id'=>3],
            ['nombre_comuna'=>'Pozo Almonte', 'alias_comuna'=>'Pozo Almonte', 'codigo_comuna'=>'1401', 'estado_comuna'=>'', 'provincia_id'=>4],
            ['nombre_comuna'=>'Camiña', 'alias_comuna'=>'Camiña', 'codigo_comuna'=>'1402', 'estado_comuna'=>'', 'provincia_id'=>4],
            ['nombre_comuna'=>'Colchane', 'alias_comuna'=>'Colchane', 'codigo_comuna'=>'1403', 'estado_comuna'=>'', 'provincia_id'=>4],
            ['nombre_comuna'=>'Huara', 'alias_comuna'=>'Huara', 'codigo_comuna'=>'1404', 'estado_comuna'=>'', 'provincia_id'=>4],
            ['nombre_comuna'=>'Pica', 'alias_comuna'=>'Pica', 'codigo_comuna'=>'1405', 'estado_comuna'=>'', 'provincia_id'=>4],
            ['nombre_comuna'=>'Antofagasta', 'alias_comuna'=>'Antofagasta', 'codigo_comuna'=>'2101', 'estado_comuna'=>'', 'provincia_id'=>5],
            ['nombre_comuna'=>'Mejillones', 'alias_comuna'=>'Mejillones', 'codigo_comuna'=>'2102', 'estado_comuna'=>'', 'provincia_id'=>5],
            ['nombre_comuna'=>'Sierra Gorda', 'alias_comuna'=>'Sierra Gorda', 'codigo_comuna'=>'2103', 'estado_comuna'=>'', 'provincia_id'=>5],
            ['nombre_comuna'=>'Taltal', 'alias_comuna'=>'Taltal', 'codigo_comuna'=>'2104', 'estado_comuna'=>'', 'provincia_id'=>5],
            ['nombre_comuna'=>'Calama', 'alias_comuna'=>'Calama', 'codigo_comuna'=>'2201', 'estado_comuna'=>'', 'provincia_id'=>6],
            ['nombre_comuna'=>'Ollagüe', 'alias_comuna'=>'Ollagüe', 'codigo_comuna'=>'2202', 'estado_comuna'=>'', 'provincia_id'=>6],
            ['nombre_comuna'=>'San Pedro de Atacama', 'alias_comuna'=>'San Pedro de Atacama', 'codigo_comuna'=>'2203', 'estado_comuna'=>'', 'provincia_id'=>6],
            ['nombre_comuna'=>'Tocopilla', 'alias_comuna'=>'Tocopilla', 'codigo_comuna'=>'2301', 'estado_comuna'=>'', 'provincia_id'=>7],
            ['nombre_comuna'=>'María Elena', 'alias_comuna'=>'María Elena', 'codigo_comuna'=>'2302', 'estado_comuna'=>'', 'provincia_id'=>7],
            ['nombre_comuna'=>'Copiapó', 'alias_comuna'=>'Copiapó', 'codigo_comuna'=>'3101', 'estado_comuna'=>'', 'provincia_id'=>8],
            ['nombre_comuna'=>'Caldera', 'alias_comuna'=>'Caldera', 'codigo_comuna'=>'3102', 'estado_comuna'=>'', 'provincia_id'=>8],
            ['nombre_comuna'=>'Tierra Amarilla', 'alias_comuna'=>'Tierra Amarilla', 'codigo_comuna'=>'3103', 'estado_comuna'=>'', 'provincia_id'=>8],
            ['nombre_comuna'=>'Chañaral', 'alias_comuna'=>'Chañaral', 'codigo_comuna'=>'3201', 'estado_comuna'=>'', 'provincia_id'=>9],
            ['nombre_comuna'=>'Diego de Almagro', 'alias_comuna'=>'Diego de Almagro', 'codigo_comuna'=>'3202', 'estado_comuna'=>'', 'provincia_id'=>9],
            ['nombre_comuna'=>'Vallenar', 'alias_comuna'=>'Vallenar', 'codigo_comuna'=>'3301', 'estado_comuna'=>'', 'provincia_id'=>10],
            ['nombre_comuna'=>'Alto del Carmen', 'alias_comuna'=>'Alto del Carmen', 'codigo_comuna'=>'3302', 'estado_comuna'=>'', 'provincia_id'=>10],
            ['nombre_comuna'=>'Freirina', 'alias_comuna'=>'Freirina', 'codigo_comuna'=>'3303', 'estado_comuna'=>'', 'provincia_id'=>10],
            ['nombre_comuna'=>'Huasco', 'alias_comuna'=>'Huasco', 'codigo_comuna'=>'3304', 'estado_comuna'=>'', 'provincia_id'=>10],
            ['nombre_comuna'=>'La Serena', 'alias_comuna'=>'La Serena', 'codigo_comuna'=>'4101', 'estado_comuna'=>'', 'provincia_id'=>11],
            ['nombre_comuna'=>'Coquimbo', 'alias_comuna'=>'Coquimbo', 'codigo_comuna'=>'4102', 'estado_comuna'=>'', 'provincia_id'=>11],
            ['nombre_comuna'=>'Andacollo', 'alias_comuna'=>'Andacollo', 'codigo_comuna'=>'4103', 'estado_comuna'=>'', 'provincia_id'=>11],
            ['nombre_comuna'=>'La Higuera', 'alias_comuna'=>'La Higuera', 'codigo_comuna'=>'4104', 'estado_comuna'=>'', 'provincia_id'=>11],
            ['nombre_comuna'=>'Paihuano', 'alias_comuna'=>'Paihuano', 'codigo_comuna'=>'4105', 'estado_comuna'=>'', 'provincia_id'=>11],
            ['nombre_comuna'=>'Vicuña', 'alias_comuna'=>'Vicuña', 'codigo_comuna'=>'4106', 'estado_comuna'=>'', 'provincia_id'=>11],
            ['nombre_comuna'=>'Illapel', 'alias_comuna'=>'Illapel', 'codigo_comuna'=>'4201', 'estado_comuna'=>'', 'provincia_id'=>12],
            ['nombre_comuna'=>'Canela', 'alias_comuna'=>'Canela', 'codigo_comuna'=>'4202', 'estado_comuna'=>'', 'provincia_id'=>12],
            ['nombre_comuna'=>'Los Vilos', 'alias_comuna'=>'Los Vilos', 'codigo_comuna'=>'4203', 'estado_comuna'=>'', 'provincia_id'=>12],
            ['nombre_comuna'=>'Salamanca', 'alias_comuna'=>'Salamanca', 'codigo_comuna'=>'4204', 'estado_comuna'=>'', 'provincia_id'=>12],
            ['nombre_comuna'=>'Ovalle', 'alias_comuna'=>'Ovalle', 'codigo_comuna'=>'4301', 'estado_comuna'=>'', 'provincia_id'=>13],
            ['nombre_comuna'=>'Combarbalá', 'alias_comuna'=>'Combarbalá', 'codigo_comuna'=>'4302', 'estado_comuna'=>'', 'provincia_id'=>13],
            ['nombre_comuna'=>'Monte Patria', 'alias_comuna'=>'Monte Patria', 'codigo_comuna'=>'4303', 'estado_comuna'=>'', 'provincia_id'=>13],
            ['nombre_comuna'=>'Punitaqui', 'alias_comuna'=>'Punitaqui', 'codigo_comuna'=>'4304', 'estado_comuna'=>'', 'provincia_id'=>13],
            ['nombre_comuna'=>'Río Hurtado', 'alias_comuna'=>'Río Hurtado', 'codigo_comuna'=>'4305', 'estado_comuna'=>'', 'provincia_id'=>13],
            ['nombre_comuna'=>'Valparaíso', 'alias_comuna'=>'Valparaíso', 'codigo_comuna'=>'5101', 'estado_comuna'=>'', 'provincia_id'=>14],
            ['nombre_comuna'=>'Casablanca', 'alias_comuna'=>'Casablanca', 'codigo_comuna'=>'5102', 'estado_comuna'=>'', 'provincia_id'=>14],
            ['nombre_comuna'=>'Concón', 'alias_comuna'=>'Concón', 'codigo_comuna'=>'5103', 'estado_comuna'=>'', 'provincia_id'=>14],
            ['nombre_comuna'=>'Juan Fernández', 'alias_comuna'=>'Juan Fernández', 'codigo_comuna'=>'5104', 'estado_comuna'=>'', 'provincia_id'=>14],
            ['nombre_comuna'=>'Puchuncaví', 'alias_comuna'=>'Puchuncaví', 'codigo_comuna'=>'5105', 'estado_comuna'=>'', 'provincia_id'=>14],
            ['nombre_comuna'=>'Quintero', 'alias_comuna'=>'Quintero', 'codigo_comuna'=>'5107', 'estado_comuna'=>'', 'provincia_id'=>14],
            ['nombre_comuna'=>'Viña del Mar', 'alias_comuna'=>'Viña del Mar', 'codigo_comuna'=>'5109', 'estado_comuna'=>'', 'provincia_id'=>14],
            ['nombre_comuna'=>'Isla de Pascua', 'alias_comuna'=>'Isla de Pascua', 'codigo_comuna'=>'5201', 'estado_comuna'=>'', 'provincia_id'=>15],
            ['nombre_comuna'=>'Los Andes', 'alias_comuna'=>'Los Andes', 'codigo_comuna'=>'5301', 'estado_comuna'=>'', 'provincia_id'=>16],
            ['nombre_comuna'=>'Calle Larga', 'alias_comuna'=>'Calle Larga', 'codigo_comuna'=>'5302', 'estado_comuna'=>'', 'provincia_id'=>16],
            ['nombre_comuna'=>'Rinconada', 'alias_comuna'=>'Rinconada', 'codigo_comuna'=>'5303', 'estado_comuna'=>'', 'provincia_id'=>16],
            ['nombre_comuna'=>'San Esteban', 'alias_comuna'=>'San Esteban', 'codigo_comuna'=>'5304', 'estado_comuna'=>'', 'provincia_id'=>16],
            ['nombre_comuna'=>'La Ligua', 'alias_comuna'=>'La Ligua', 'codigo_comuna'=>'5401', 'estado_comuna'=>'', 'provincia_id'=>17],
            ['nombre_comuna'=>'Cabildo', 'alias_comuna'=>'Cabildo', 'codigo_comuna'=>'5402', 'estado_comuna'=>'', 'provincia_id'=>17],
            ['nombre_comuna'=>'Papudo', 'alias_comuna'=>'Papudo', 'codigo_comuna'=>'5403', 'estado_comuna'=>'', 'provincia_id'=>17],
            ['nombre_comuna'=>'Petorca', 'alias_comuna'=>'Petorca', 'codigo_comuna'=>'5404', 'estado_comuna'=>'', 'provincia_id'=>17],
            ['nombre_comuna'=>'Zapallar', 'alias_comuna'=>'Zapallar', 'codigo_comuna'=>'5405', 'estado_comuna'=>'', 'provincia_id'=>17],
            ['nombre_comuna'=>'Quillota', 'alias_comuna'=>'Quillota', 'codigo_comuna'=>'5501', 'estado_comuna'=>'', 'provincia_id'=>18],
            ['nombre_comuna'=>'La Calera', 'alias_comuna'=>'La Calera', 'codigo_comuna'=>'5502', 'estado_comuna'=>'', 'provincia_id'=>18],
            ['nombre_comuna'=>'Hijuelas', 'alias_comuna'=>'Hijuelas', 'codigo_comuna'=>'5503', 'estado_comuna'=>'', 'provincia_id'=>18],
            ['nombre_comuna'=>'La Cruz', 'alias_comuna'=>'La Cruz', 'codigo_comuna'=>'5504', 'estado_comuna'=>'', 'provincia_id'=>18],
            ['nombre_comuna'=>'Nogales', 'alias_comuna'=>'Nogales', 'codigo_comuna'=>'5506', 'estado_comuna'=>'', 'provincia_id'=>18],
            ['nombre_comuna'=>'San Antonio', 'alias_comuna'=>'San Antonio', 'codigo_comuna'=>'5601', 'estado_comuna'=>'', 'provincia_id'=>19],
            ['nombre_comuna'=>'Algarrobo', 'alias_comuna'=>'Algarrobo', 'codigo_comuna'=>'5602', 'estado_comuna'=>'', 'provincia_id'=>19],
            ['nombre_comuna'=>'Cartagena', 'alias_comuna'=>'Cartagena', 'codigo_comuna'=>'5603', 'estado_comuna'=>'', 'provincia_id'=>19],
            ['nombre_comuna'=>'El Quisco', 'alias_comuna'=>'El Quisco', 'codigo_comuna'=>'5604', 'estado_comuna'=>'', 'provincia_id'=>19],
            ['nombre_comuna'=>'El Tabo', 'alias_comuna'=>'El Tabo', 'codigo_comuna'=>'5605', 'estado_comuna'=>'', 'provincia_id'=>19],
            ['nombre_comuna'=>'Santo Domingo', 'alias_comuna'=>'Santo Domingo', 'codigo_comuna'=>'5606', 'estado_comuna'=>'', 'provincia_id'=>19],
            ['nombre_comuna'=>'San Felipe', 'alias_comuna'=>'San Felipe', 'codigo_comuna'=>'5701', 'estado_comuna'=>'', 'provincia_id'=>20],
            ['nombre_comuna'=>'Catemu', 'alias_comuna'=>'Catemu', 'codigo_comuna'=>'5702', 'estado_comuna'=>'', 'provincia_id'=>20],
            ['nombre_comuna'=>'Llay-Llay', 'alias_comuna'=>'Llay-Llay', 'codigo_comuna'=>'5703', 'estado_comuna'=>'', 'provincia_id'=>20],
            ['nombre_comuna'=>'Panquehue', 'alias_comuna'=>'Panquehue', 'codigo_comuna'=>'5704', 'estado_comuna'=>'', 'provincia_id'=>20],
            ['nombre_comuna'=>'Putaendo', 'alias_comuna'=>'Putaendo', 'codigo_comuna'=>'5705', 'estado_comuna'=>'', 'provincia_id'=>20],
            ['nombre_comuna'=>'Santa María', 'alias_comuna'=>'Santa María', 'codigo_comuna'=>'5706', 'estado_comuna'=>'', 'provincia_id'=>20],
            ['nombre_comuna'=>'Quilpué', 'alias_comuna'=>'Quilpué', 'codigo_comuna'=>'5801', 'estado_comuna'=>'', 'provincia_id'=>21],
            ['nombre_comuna'=>'Limache', 'alias_comuna'=>'Limache', 'codigo_comuna'=>'5802', 'estado_comuna'=>'', 'provincia_id'=>21],
            ['nombre_comuna'=>'Olmué', 'alias_comuna'=>'Olmué', 'codigo_comuna'=>'5803', 'estado_comuna'=>'', 'provincia_id'=>21],
            ['nombre_comuna'=>'Villa Alemana', 'alias_comuna'=>'Villa Alemana', 'codigo_comuna'=>'5804', 'estado_comuna'=>'', 'provincia_id'=>21],
            ['nombre_comuna'=>'Rancagua', 'alias_comuna'=>'Rancagua', 'codigo_comuna'=>'6101', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Codegua', 'alias_comuna'=>'Codegua', 'codigo_comuna'=>'6102', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Coinco', 'alias_comuna'=>'Coinco', 'codigo_comuna'=>'6103', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Coltauco', 'alias_comuna'=>'Coltauco', 'codigo_comuna'=>'6104', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Doñihue', 'alias_comuna'=>'Doñihue', 'codigo_comuna'=>'6105', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Graneros', 'alias_comuna'=>'Graneros', 'codigo_comuna'=>'6106', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Las Cabras', 'alias_comuna'=>'Las Cabras', 'codigo_comuna'=>'6107', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Machalí', 'alias_comuna'=>'Machalí', 'codigo_comuna'=>'6108', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Malloa', 'alias_comuna'=>'Malloa', 'codigo_comuna'=>'6109', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Mostazal', 'alias_comuna'=>'Mostazal', 'codigo_comuna'=>'6110', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Olivar', 'alias_comuna'=>'Olivar', 'codigo_comuna'=>'6111', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Peumo', 'alias_comuna'=>'Peumo', 'codigo_comuna'=>'6112', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Pichidegua', 'alias_comuna'=>'Pichidegua', 'codigo_comuna'=>'6113', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Quinta de Tilcoco', 'alias_comuna'=>'Quinta de Tilcoco', 'codigo_comuna'=>'6114', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Rengo', 'alias_comuna'=>'Rengo', 'codigo_comuna'=>'6115', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Requínoa', 'alias_comuna'=>'Requínoa', 'codigo_comuna'=>'6116', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'San Vicente', 'alias_comuna'=>'San Vicente', 'codigo_comuna'=>'6117', 'estado_comuna'=>'', 'provincia_id'=>22],
            ['nombre_comuna'=>'Pichilemu', 'alias_comuna'=>'Pichilemu', 'codigo_comuna'=>'6201', 'estado_comuna'=>'', 'provincia_id'=>23],
            ['nombre_comuna'=>'La Estrella', 'alias_comuna'=>'La Estrella', 'codigo_comuna'=>'6202', 'estado_comuna'=>'', 'provincia_id'=>23],
            ['nombre_comuna'=>'Litueche', 'alias_comuna'=>'Litueche', 'codigo_comuna'=>'6203', 'estado_comuna'=>'', 'provincia_id'=>23],
            ['nombre_comuna'=>'Marchihue', 'alias_comuna'=>'Marchihue', 'codigo_comuna'=>'6204', 'estado_comuna'=>'', 'provincia_id'=>23],
            ['nombre_comuna'=>'Navidad', 'alias_comuna'=>'Navidad', 'codigo_comuna'=>'6205', 'estado_comuna'=>'', 'provincia_id'=>23],
            ['nombre_comuna'=>'Paredones', 'alias_comuna'=>'Paredones', 'codigo_comuna'=>'6206', 'estado_comuna'=>'', 'provincia_id'=>23],
            ['nombre_comuna'=>'San Fernando', 'alias_comuna'=>'San Fernando', 'codigo_comuna'=>'6301', 'estado_comuna'=>'', 'provincia_id'=>24],
            ['nombre_comuna'=>'Chépica', 'alias_comuna'=>'Chépica', 'codigo_comuna'=>'6302', 'estado_comuna'=>'', 'provincia_id'=>24],
            ['nombre_comuna'=>'Chimbarongo', 'alias_comuna'=>'Chimbarongo', 'codigo_comuna'=>'6303', 'estado_comuna'=>'', 'provincia_id'=>24],
            ['nombre_comuna'=>'Lolol', 'alias_comuna'=>'Lolol', 'codigo_comuna'=>'6304', 'estado_comuna'=>'', 'provincia_id'=>24],
            ['nombre_comuna'=>'Nancagua', 'alias_comuna'=>'Nancagua', 'codigo_comuna'=>'6305', 'estado_comuna'=>'', 'provincia_id'=>24],
            ['nombre_comuna'=>'Palmilla', 'alias_comuna'=>'Palmilla', 'codigo_comuna'=>'6306', 'estado_comuna'=>'', 'provincia_id'=>24],
            ['nombre_comuna'=>'Peralillo', 'alias_comuna'=>'Peralillo', 'codigo_comuna'=>'6307', 'estado_comuna'=>'', 'provincia_id'=>24],
            ['nombre_comuna'=>'Placilla', 'alias_comuna'=>'Placilla', 'codigo_comuna'=>'6308', 'estado_comuna'=>'', 'provincia_id'=>24],
            ['nombre_comuna'=>'Pumanque', 'alias_comuna'=>'Pumanque', 'codigo_comuna'=>'6309', 'estado_comuna'=>'', 'provincia_id'=>24],
            ['nombre_comuna'=>'Santa Cruz', 'alias_comuna'=>'Santa Cruz', 'codigo_comuna'=>'6310', 'estado_comuna'=>'', 'provincia_id'=>24],
            ['nombre_comuna'=>'Talca', 'alias_comuna'=>'Talca', 'codigo_comuna'=>'7101', 'estado_comuna'=>'', 'provincia_id'=>25],
            ['nombre_comuna'=>'Constitución', 'alias_comuna'=>'Constitución', 'codigo_comuna'=>'7102', 'estado_comuna'=>'', 'provincia_id'=>25],
            ['nombre_comuna'=>'Curepto', 'alias_comuna'=>'Curepto', 'codigo_comuna'=>'7103', 'estado_comuna'=>'', 'provincia_id'=>25],
            ['nombre_comuna'=>'Empedrado', 'alias_comuna'=>'Empedrado', 'codigo_comuna'=>'7104', 'estado_comuna'=>'', 'provincia_id'=>25],
            ['nombre_comuna'=>'Maule', 'alias_comuna'=>'Maule', 'codigo_comuna'=>'7105', 'estado_comuna'=>'', 'provincia_id'=>25],
            ['nombre_comuna'=>'Pelarco', 'alias_comuna'=>'Pelarco', 'codigo_comuna'=>'7106', 'estado_comuna'=>'', 'provincia_id'=>25],
            ['nombre_comuna'=>'Pencahue', 'alias_comuna'=>'Pencahue', 'codigo_comuna'=>'7107', 'estado_comuna'=>'', 'provincia_id'=>25],
            ['nombre_comuna'=>'Río Claro', 'alias_comuna'=>'Río Claro', 'codigo_comuna'=>'7108', 'estado_comuna'=>'', 'provincia_id'=>25],
            ['nombre_comuna'=>'San Clemente', 'alias_comuna'=>'San Clemente', 'codigo_comuna'=>'7109', 'estado_comuna'=>'', 'provincia_id'=>25],
            ['nombre_comuna'=>'San Rafael', 'alias_comuna'=>'San Rafael', 'codigo_comuna'=>'7110', 'estado_comuna'=>'', 'provincia_id'=>25],
            ['nombre_comuna'=>'Cauquenes', 'alias_comuna'=>'Cauquenes', 'codigo_comuna'=>'7201', 'estado_comuna'=>'', 'provincia_id'=>26],
            ['nombre_comuna'=>'Chanco', 'alias_comuna'=>'Chanco', 'codigo_comuna'=>'7202', 'estado_comuna'=>'', 'provincia_id'=>26],
            ['nombre_comuna'=>'Pelluhue', 'alias_comuna'=>'Pelluhue', 'codigo_comuna'=>'7203', 'estado_comuna'=>'', 'provincia_id'=>26],
            ['nombre_comuna'=>'Curicó', 'alias_comuna'=>'Curicó', 'codigo_comuna'=>'7301', 'estado_comuna'=>'', 'provincia_id'=>27],
            ['nombre_comuna'=>'Hualañé', 'alias_comuna'=>'Hualañé', 'codigo_comuna'=>'7302', 'estado_comuna'=>'', 'provincia_id'=>27],
            ['nombre_comuna'=>'Licantén', 'alias_comuna'=>'Licantén', 'codigo_comuna'=>'7303', 'estado_comuna'=>'', 'provincia_id'=>27],
            ['nombre_comuna'=>'Molina', 'alias_comuna'=>'Molina', 'codigo_comuna'=>'7304', 'estado_comuna'=>'', 'provincia_id'=>27],
            ['nombre_comuna'=>'Rauco', 'alias_comuna'=>'Rauco', 'codigo_comuna'=>'7305', 'estado_comuna'=>'', 'provincia_id'=>27],
            ['nombre_comuna'=>'Romeral', 'alias_comuna'=>'Romeral', 'codigo_comuna'=>'7306', 'estado_comuna'=>'', 'provincia_id'=>27],
            ['nombre_comuna'=>'Sagrada Familia', 'alias_comuna'=>'Sagrada Familia', 'codigo_comuna'=>'7307', 'estado_comuna'=>'', 'provincia_id'=>27],
            ['nombre_comuna'=>'Teno', 'alias_comuna'=>'Teno', 'codigo_comuna'=>'7308', 'estado_comuna'=>'', 'provincia_id'=>27],
            ['nombre_comuna'=>'Vichuquén', 'alias_comuna'=>'Vichuquén', 'codigo_comuna'=>'7309', 'estado_comuna'=>'', 'provincia_id'=>27],
            ['nombre_comuna'=>'Linares', 'alias_comuna'=>'Linares', 'codigo_comuna'=>'7401', 'estado_comuna'=>'', 'provincia_id'=>28],
            ['nombre_comuna'=>'Colbún', 'alias_comuna'=>'Colbún', 'codigo_comuna'=>'7402', 'estado_comuna'=>'', 'provincia_id'=>28],
            ['nombre_comuna'=>'Longaví', 'alias_comuna'=>'Longaví', 'codigo_comuna'=>'7403', 'estado_comuna'=>'', 'provincia_id'=>28],
            ['nombre_comuna'=>'Parral', 'alias_comuna'=>'Parral', 'codigo_comuna'=>'7404', 'estado_comuna'=>'', 'provincia_id'=>28],
            ['nombre_comuna'=>'Retiro', 'alias_comuna'=>'Retiro', 'codigo_comuna'=>'7405', 'estado_comuna'=>'', 'provincia_id'=>28],
            ['nombre_comuna'=>'San Javier', 'alias_comuna'=>'San Javier', 'codigo_comuna'=>'7406', 'estado_comuna'=>'', 'provincia_id'=>28],
            ['nombre_comuna'=>'Villa Alegre', 'alias_comuna'=>'Villa Alegre', 'codigo_comuna'=>'7407', 'estado_comuna'=>'', 'provincia_id'=>28],
            ['nombre_comuna'=>'Yerbas Buenas', 'alias_comuna'=>'Yerbas Buenas', 'codigo_comuna'=>'7408', 'estado_comuna'=>'', 'provincia_id'=>28],
            ['nombre_comuna'=>'San Carlos', 'alias_comuna'=>'San Carlos', 'codigo_comuna'=>'8416', 'estado_comuna'=>'', 'provincia_id'=>29],
            ['nombre_comuna'=>'San Fabián', 'alias_comuna'=>'San Fabián', 'codigo_comuna'=>'8417', 'estado_comuna'=>'', 'provincia_id'=>29],
            ['nombre_comuna'=>'Coihueco', 'alias_comuna'=>'Coihueco', 'codigo_comuna'=>'8405', 'estado_comuna'=>'', 'provincia_id'=>29],
            ['nombre_comuna'=>'Ñiquén', 'alias_comuna'=>'Ñiquén', 'codigo_comuna'=>'8409', 'estado_comuna'=>'', 'provincia_id'=>29],
            ['nombre_comuna'=>'San Nicolás', 'alias_comuna'=>'San Nicolás', 'codigo_comuna'=>'8419', 'estado_comuna'=>'', 'provincia_id'=>29],
            ['nombre_comuna'=>'Bulnes', 'alias_comuna'=>'Bulnes', 'codigo_comuna'=>'8402', 'estado_comuna'=>'', 'provincia_id'=>30],
            ['nombre_comuna'=>'Chillán', 'alias_comuna'=>'Chillán', 'codigo_comuna'=>'8401', 'estado_comuna'=>'', 'provincia_id'=>30],
            ['nombre_comuna'=>'Chillán Viejo', 'alias_comuna'=>'Chillán Viejo', 'codigo_comuna'=>'8406', 'estado_comuna'=>'', 'provincia_id'=>30],
            ['nombre_comuna'=>'El Carmen', 'alias_comuna'=>'El Carmen', 'codigo_comuna'=>'8407', 'estado_comuna'=>'', 'provincia_id'=>30],
            ['nombre_comuna'=>'Pemuco', 'alias_comuna'=>'Pemuco', 'codigo_comuna'=>'8410', 'estado_comuna'=>'', 'provincia_id'=>30],
            ['nombre_comuna'=>'Pinto', 'alias_comuna'=>'Pinto', 'codigo_comuna'=>'8411', 'estado_comuna'=>'', 'provincia_id'=>30],
            ['nombre_comuna'=>'Quillón', 'alias_comuna'=>'Quillón', 'codigo_comuna'=>'8413', 'estado_comuna'=>'', 'provincia_id'=>30],
            ['nombre_comuna'=>'San Ignacio', 'alias_comuna'=>'San Ignacio', 'codigo_comuna'=>'8418', 'estado_comuna'=>'', 'provincia_id'=>30],
            ['nombre_comuna'=>'Yungay', 'alias_comuna'=>'Yungay', 'codigo_comuna'=>'8421', 'estado_comuna'=>'', 'provincia_id'=>30],
            ['nombre_comuna'=>'Quirihue', 'alias_comuna'=>'Quirihue', 'codigo_comuna'=>'8414', 'estado_comuna'=>'', 'provincia_id'=>31],
            ['nombre_comuna'=>'Cobquecura', 'alias_comuna'=>'Cobquecura', 'codigo_comuna'=>'8403', 'estado_comuna'=>'', 'provincia_id'=>31],
            ['nombre_comuna'=>'Coelemu', 'alias_comuna'=>'Coelemu', 'codigo_comuna'=>'8404', 'estado_comuna'=>'', 'provincia_id'=>31],
            ['nombre_comuna'=>'Ninhue', 'alias_comuna'=>'Ninhue', 'codigo_comuna'=>'8408', 'estado_comuna'=>'', 'provincia_id'=>31],
            ['nombre_comuna'=>'Portezuelo', 'alias_comuna'=>'Portezuelo', 'codigo_comuna'=>'8412', 'estado_comuna'=>'', 'provincia_id'=>31],
            ['nombre_comuna'=>'Ránquil', 'alias_comuna'=>'Ránquil', 'codigo_comuna'=>'8415', 'estado_comuna'=>'', 'provincia_id'=>31],
            ['nombre_comuna'=>'Treguaco', 'alias_comuna'=>'Treguaco', 'codigo_comuna'=>'8420', 'estado_comuna'=>'', 'provincia_id'=>31],
            ['nombre_comuna'=>'Concepción', 'alias_comuna'=>'Concepción', 'codigo_comuna'=>'8101', 'estado_comuna'=>'', 'provincia_id'=>32],
            ['nombre_comuna'=>'Coronel', 'alias_comuna'=>'Coronel', 'codigo_comuna'=>'8102', 'estado_comuna'=>'', 'provincia_id'=>32],
            ['nombre_comuna'=>'Chiguayante', 'alias_comuna'=>'Chiguayante', 'codigo_comuna'=>'8103', 'estado_comuna'=>'', 'provincia_id'=>32],
            ['nombre_comuna'=>'Florida', 'alias_comuna'=>'Florida', 'codigo_comuna'=>'8104', 'estado_comuna'=>'', 'provincia_id'=>32],
            ['nombre_comuna'=>'Hualqui', 'alias_comuna'=>'Hualqui', 'codigo_comuna'=>'8105', 'estado_comuna'=>'', 'provincia_id'=>32],
            ['nombre_comuna'=>'Lota', 'alias_comuna'=>'Lota', 'codigo_comuna'=>'8106', 'estado_comuna'=>'', 'provincia_id'=>32],
            ['nombre_comuna'=>'Penco', 'alias_comuna'=>'Penco', 'codigo_comuna'=>'8107', 'estado_comuna'=>'', 'provincia_id'=>32],
            ['nombre_comuna'=>'San Pedro de La Paz', 'alias_comuna'=>'San Pedro de La Paz', 'codigo_comuna'=>'8108', 'estado_comuna'=>'', 'provincia_id'=>32],
            ['nombre_comuna'=>'Santa Juana', 'alias_comuna'=>'Santa Juana', 'codigo_comuna'=>'8109', 'estado_comuna'=>'', 'provincia_id'=>32],
            ['nombre_comuna'=>'Talcahuano', 'alias_comuna'=>'Talcahuano', 'codigo_comuna'=>'8110', 'estado_comuna'=>'', 'provincia_id'=>32],
            ['nombre_comuna'=>'Tomé', 'alias_comuna'=>'Tomé', 'codigo_comuna'=>'8111', 'estado_comuna'=>'', 'provincia_id'=>32],
            ['nombre_comuna'=>'Hualpén', 'alias_comuna'=>'Hualpén', 'codigo_comuna'=>'8112', 'estado_comuna'=>'', 'provincia_id'=>32],
            ['nombre_comuna'=>'Lebu', 'alias_comuna'=>'Lebu', 'codigo_comuna'=>'8201', 'estado_comuna'=>'', 'provincia_id'=>33],
            ['nombre_comuna'=>'Arauco', 'alias_comuna'=>'Arauco', 'codigo_comuna'=>'8202', 'estado_comuna'=>'', 'provincia_id'=>33],
            ['nombre_comuna'=>'Cañete', 'alias_comuna'=>'Cañete', 'codigo_comuna'=>'8203', 'estado_comuna'=>'', 'provincia_id'=>33],
            ['nombre_comuna'=>'Contulmo', 'alias_comuna'=>'Contulmo', 'codigo_comuna'=>'8204', 'estado_comuna'=>'', 'provincia_id'=>33],
            ['nombre_comuna'=>'Curanilahue', 'alias_comuna'=>'Curanilahue', 'codigo_comuna'=>'8205', 'estado_comuna'=>'', 'provincia_id'=>33],
            ['nombre_comuna'=>'Los Álamos', 'alias_comuna'=>'Los Álamos', 'codigo_comuna'=>'8206', 'estado_comuna'=>'', 'provincia_id'=>33],
            ['nombre_comuna'=>'Tirúa', 'alias_comuna'=>'Tirúa', 'codigo_comuna'=>'8207', 'estado_comuna'=>'', 'provincia_id'=>33],
            ['nombre_comuna'=>'Los Ángeles', 'alias_comuna'=>'Los Ángeles', 'codigo_comuna'=>'8301', 'estado_comuna'=>'', 'provincia_id'=>34],
            ['nombre_comuna'=>'Antuco', 'alias_comuna'=>'Antuco', 'codigo_comuna'=>'8302', 'estado_comuna'=>'', 'provincia_id'=>34],
            ['nombre_comuna'=>'Cabrero', 'alias_comuna'=>'Cabrero', 'codigo_comuna'=>'8303', 'estado_comuna'=>'', 'provincia_id'=>34],
            ['nombre_comuna'=>'Laja', 'alias_comuna'=>'Laja', 'codigo_comuna'=>'8304', 'estado_comuna'=>'', 'provincia_id'=>34],
            ['nombre_comuna'=>'Mulchén', 'alias_comuna'=>'Mulchén', 'codigo_comuna'=>'8305', 'estado_comuna'=>'', 'provincia_id'=>34],
            ['nombre_comuna'=>'Nacimiento', 'alias_comuna'=>'Nacimiento', 'codigo_comuna'=>'8306', 'estado_comuna'=>'', 'provincia_id'=>34],
            ['nombre_comuna'=>'Negrete', 'alias_comuna'=>'Negrete', 'codigo_comuna'=>'8307', 'estado_comuna'=>'', 'provincia_id'=>34],
            ['nombre_comuna'=>'Quilaco', 'alias_comuna'=>'Quilaco', 'codigo_comuna'=>'8308', 'estado_comuna'=>'', 'provincia_id'=>34],
            ['nombre_comuna'=>'Quilleco', 'alias_comuna'=>'Quilleco', 'codigo_comuna'=>'8309', 'estado_comuna'=>'', 'provincia_id'=>34],
            ['nombre_comuna'=>'San Rosendo', 'alias_comuna'=>'San Rosendo', 'codigo_comuna'=>'8310', 'estado_comuna'=>'', 'provincia_id'=>34],
            ['nombre_comuna'=>'Santa Bárbara', 'alias_comuna'=>'Santa Bárbara', 'codigo_comuna'=>'8311', 'estado_comuna'=>'', 'provincia_id'=>34],
            ['nombre_comuna'=>'Tucapel', 'alias_comuna'=>'Tucapel', 'codigo_comuna'=>'8312', 'estado_comuna'=>'', 'provincia_id'=>34],
            ['nombre_comuna'=>'Yumbel', 'alias_comuna'=>'Yumbel', 'codigo_comuna'=>'8313', 'estado_comuna'=>'', 'provincia_id'=>34],
            ['nombre_comuna'=>'Alto Biobío', 'alias_comuna'=>'Alto Biobío', 'codigo_comuna'=>'8314', 'estado_comuna'=>'', 'provincia_id'=>34],
            ['nombre_comuna'=>'Temuco', 'alias_comuna'=>'Temuco', 'codigo_comuna'=>'9101', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Carahue', 'alias_comuna'=>'Carahue', 'codigo_comuna'=>'9102', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Cunco', 'alias_comuna'=>'Cunco', 'codigo_comuna'=>'9103', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Curarrehue', 'alias_comuna'=>'Curarrehue', 'codigo_comuna'=>'9104', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Freire', 'alias_comuna'=>'Freire', 'codigo_comuna'=>'9105', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Galvarino', 'alias_comuna'=>'Galvarino', 'codigo_comuna'=>'9106', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Gorbea', 'alias_comuna'=>'Gorbea', 'codigo_comuna'=>'9107', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Lautaro', 'alias_comuna'=>'Lautaro', 'codigo_comuna'=>'9108', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Loncoche', 'alias_comuna'=>'Loncoche', 'codigo_comuna'=>'9109', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Melipeuco', 'alias_comuna'=>'Melipeuco', 'codigo_comuna'=>'9110', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Nueva Imperial', 'alias_comuna'=>'Nueva Imperial', 'codigo_comuna'=>'9111', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Padre Las Casas', 'alias_comuna'=>'Padre Las Casas', 'codigo_comuna'=>'9112', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Perquenco', 'alias_comuna'=>'Perquenco', 'codigo_comuna'=>'9113', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Pitrufquén', 'alias_comuna'=>'Pitrufquén', 'codigo_comuna'=>'9114', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Pucón', 'alias_comuna'=>'Pucón', 'codigo_comuna'=>'9115', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Saavedra', 'alias_comuna'=>'Saavedra', 'codigo_comuna'=>'9116', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Teodoro Schmidt', 'alias_comuna'=>'Teodoro Schmidt', 'codigo_comuna'=>'9117', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Toltén', 'alias_comuna'=>'Toltén', 'codigo_comuna'=>'9118', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Vilcún', 'alias_comuna'=>'Vilcún', 'codigo_comuna'=>'9119', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Villarrica', 'alias_comuna'=>'Villarrica', 'codigo_comuna'=>'9120', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Cholchol', 'alias_comuna'=>'Cholchol', 'codigo_comuna'=>'9121', 'estado_comuna'=>'', 'provincia_id'=>35],
            ['nombre_comuna'=>'Angol', 'alias_comuna'=>'Angol', 'codigo_comuna'=>'9201', 'estado_comuna'=>'', 'provincia_id'=>36],
            ['nombre_comuna'=>'Collipulli', 'alias_comuna'=>'Collipulli', 'codigo_comuna'=>'9202', 'estado_comuna'=>'', 'provincia_id'=>36],
            ['nombre_comuna'=>'Curacautín', 'alias_comuna'=>'Curacautín', 'codigo_comuna'=>'9203', 'estado_comuna'=>'', 'provincia_id'=>36],
            ['nombre_comuna'=>'Ercilla', 'alias_comuna'=>'Ercilla', 'codigo_comuna'=>'9204', 'estado_comuna'=>'', 'provincia_id'=>36],
            ['nombre_comuna'=>'Lonquimay', 'alias_comuna'=>'Lonquimay', 'codigo_comuna'=>'9205', 'estado_comuna'=>'', 'provincia_id'=>36],
            ['nombre_comuna'=>'Los Sauces', 'alias_comuna'=>'Los Sauces', 'codigo_comuna'=>'9206', 'estado_comuna'=>'', 'provincia_id'=>36],
            ['nombre_comuna'=>'Lumaco', 'alias_comuna'=>'Lumaco', 'codigo_comuna'=>'9207', 'estado_comuna'=>'', 'provincia_id'=>36],
            ['nombre_comuna'=>'Purén', 'alias_comuna'=>'Purén', 'codigo_comuna'=>'9208', 'estado_comuna'=>'', 'provincia_id'=>36],
            ['nombre_comuna'=>'Renaico', 'alias_comuna'=>'Renaico', 'codigo_comuna'=>'9209', 'estado_comuna'=>'', 'provincia_id'=>36],
            ['nombre_comuna'=>'Traiguén', 'alias_comuna'=>'Traiguén', 'codigo_comuna'=>'9210', 'estado_comuna'=>'', 'provincia_id'=>36],
            ['nombre_comuna'=>'Victoria', 'alias_comuna'=>'Victoria', 'codigo_comuna'=>'9211', 'estado_comuna'=>'', 'provincia_id'=>36],
            ['nombre_comuna'=>'Valdivia', 'alias_comuna'=>'Valdivia', 'codigo_comuna'=>'14101', 'estado_comuna'=>'', 'provincia_id'=>37],
            ['nombre_comuna'=>'Corral', 'alias_comuna'=>'Corral', 'codigo_comuna'=>'14102', 'estado_comuna'=>'', 'provincia_id'=>37],
            ['nombre_comuna'=>'Lanco', 'alias_comuna'=>'Lanco', 'codigo_comuna'=>'14103', 'estado_comuna'=>'', 'provincia_id'=>37],
            ['nombre_comuna'=>'Los Lagos', 'alias_comuna'=>'Los Lagos', 'codigo_comuna'=>'14104', 'estado_comuna'=>'', 'provincia_id'=>37],
            ['nombre_comuna'=>'Máfil', 'alias_comuna'=>'Máfil', 'codigo_comuna'=>'14105', 'estado_comuna'=>'', 'provincia_id'=>37],
            ['nombre_comuna'=>'Mariquina', 'alias_comuna'=>'Mariquina', 'codigo_comuna'=>'14106', 'estado_comuna'=>'', 'provincia_id'=>37],
            ['nombre_comuna'=>'Paillaco', 'alias_comuna'=>'Paillaco', 'codigo_comuna'=>'14107', 'estado_comuna'=>'', 'provincia_id'=>37],
            ['nombre_comuna'=>'Panguipulli', 'alias_comuna'=>'Panguipulli', 'codigo_comuna'=>'14108', 'estado_comuna'=>'', 'provincia_id'=>37],
            ['nombre_comuna'=>'La Unión', 'alias_comuna'=>'La Unión', 'codigo_comuna'=>'14201', 'estado_comuna'=>'', 'provincia_id'=>38],
            ['nombre_comuna'=>'Futrono', 'alias_comuna'=>'Futrono', 'codigo_comuna'=>'14202', 'estado_comuna'=>'', 'provincia_id'=>38],
            ['nombre_comuna'=>'Lago Ranco', 'alias_comuna'=>'Lago Ranco', 'codigo_comuna'=>'14203', 'estado_comuna'=>'', 'provincia_id'=>38],
            ['nombre_comuna'=>'Río Bueno', 'alias_comuna'=>'Río Bueno', 'codigo_comuna'=>'14204', 'estado_comuna'=>'', 'provincia_id'=>38],
            ['nombre_comuna'=>'Puerto Montt', 'alias_comuna'=>'Puerto Montt', 'codigo_comuna'=>'10101', 'estado_comuna'=>'', 'provincia_id'=>39],
            ['nombre_comuna'=>'Calbuco', 'alias_comuna'=>'Calbuco', 'codigo_comuna'=>'10102', 'estado_comuna'=>'', 'provincia_id'=>39],
            ['nombre_comuna'=>'Cochamó', 'alias_comuna'=>'Cochamó', 'codigo_comuna'=>'10103', 'estado_comuna'=>'', 'provincia_id'=>39],
            ['nombre_comuna'=>'Fresia', 'alias_comuna'=>'Fresia', 'codigo_comuna'=>'10104', 'estado_comuna'=>'', 'provincia_id'=>39],
            ['nombre_comuna'=>'Frutillar', 'alias_comuna'=>'Frutillar', 'codigo_comuna'=>'10105', 'estado_comuna'=>'', 'provincia_id'=>39],
            ['nombre_comuna'=>'Los Muermos', 'alias_comuna'=>'Los Muermos', 'codigo_comuna'=>'10106', 'estado_comuna'=>'', 'provincia_id'=>39],
            ['nombre_comuna'=>'Llanquihue', 'alias_comuna'=>'Llanquihue', 'codigo_comuna'=>'10107', 'estado_comuna'=>'', 'provincia_id'=>39],
            ['nombre_comuna'=>'Maullín', 'alias_comuna'=>'Maullín', 'codigo_comuna'=>'10108', 'estado_comuna'=>'', 'provincia_id'=>39],
            ['nombre_comuna'=>'Puerto Varas', 'alias_comuna'=>'Puerto Varas', 'codigo_comuna'=>'10109', 'estado_comuna'=>'', 'provincia_id'=>39],
            ['nombre_comuna'=>'Castro', 'alias_comuna'=>'Castro', 'codigo_comuna'=>'10201', 'estado_comuna'=>'', 'provincia_id'=>40],
            ['nombre_comuna'=>'Ancud', 'alias_comuna'=>'Ancud', 'codigo_comuna'=>'10202', 'estado_comuna'=>'', 'provincia_id'=>40],
            ['nombre_comuna'=>'Chonchi', 'alias_comuna'=>'Chonchi', 'codigo_comuna'=>'10203', 'estado_comuna'=>'', 'provincia_id'=>40],
            ['nombre_comuna'=>'Curaco de Vélez', 'alias_comuna'=>'Curaco de Vélez', 'codigo_comuna'=>'10204', 'estado_comuna'=>'', 'provincia_id'=>40],
            ['nombre_comuna'=>'Dalcahue', 'alias_comuna'=>'Dalcahue', 'codigo_comuna'=>'10205', 'estado_comuna'=>'', 'provincia_id'=>40],
            ['nombre_comuna'=>'Puqueldón', 'alias_comuna'=>'Puqueldón', 'codigo_comuna'=>'10206', 'estado_comuna'=>'', 'provincia_id'=>40],
            ['nombre_comuna'=>'Queilén', 'alias_comuna'=>'Queilén', 'codigo_comuna'=>'10207', 'estado_comuna'=>'', 'provincia_id'=>40],
            ['nombre_comuna'=>'Quellón', 'alias_comuna'=>'Quellón', 'codigo_comuna'=>'10208', 'estado_comuna'=>'', 'provincia_id'=>40],
            ['nombre_comuna'=>'Quemchi', 'alias_comuna'=>'Quemchi', 'codigo_comuna'=>'10209', 'estado_comuna'=>'', 'provincia_id'=>40],
            ['nombre_comuna'=>'Quinchao', 'alias_comuna'=>'Quinchao', 'codigo_comuna'=>'10210', 'estado_comuna'=>'', 'provincia_id'=>40],
            ['nombre_comuna'=>'Osorno', 'alias_comuna'=>'Osorno', 'codigo_comuna'=>'10301', 'estado_comuna'=>'', 'provincia_id'=>41],
            ['nombre_comuna'=>'Puerto Octay', 'alias_comuna'=>'Puerto Octay', 'codigo_comuna'=>'10302', 'estado_comuna'=>'', 'provincia_id'=>41],
            ['nombre_comuna'=>'Purranque', 'alias_comuna'=>'Purranque', 'codigo_comuna'=>'10303', 'estado_comuna'=>'', 'provincia_id'=>41],
            ['nombre_comuna'=>'Puyehue', 'alias_comuna'=>'Puyehue', 'codigo_comuna'=>'10304', 'estado_comuna'=>'', 'provincia_id'=>41],
            ['nombre_comuna'=>'Río Negro', 'alias_comuna'=>'Río Negro', 'codigo_comuna'=>'10305', 'estado_comuna'=>'', 'provincia_id'=>41],
            ['nombre_comuna'=>'San Juan de la Costa', 'alias_comuna'=>'San Juan de la Costa', 'codigo_comuna'=>'10306', 'estado_comuna'=>'', 'provincia_id'=>41],
            ['nombre_comuna'=>'San Pablo', 'alias_comuna'=>'San Pablo', 'codigo_comuna'=>'10307', 'estado_comuna'=>'', 'provincia_id'=>41],
            ['nombre_comuna'=>'Chaitén', 'alias_comuna'=>'Chaitén', 'codigo_comuna'=>'10401', 'estado_comuna'=>'', 'provincia_id'=>42],
            ['nombre_comuna'=>'Futaleufú', 'alias_comuna'=>'Futaleufú', 'codigo_comuna'=>'10402', 'estado_comuna'=>'', 'provincia_id'=>42],
            ['nombre_comuna'=>'Hualaihué', 'alias_comuna'=>'Hualaihué', 'codigo_comuna'=>'10403', 'estado_comuna'=>'', 'provincia_id'=>42],
            ['nombre_comuna'=>'Palena', 'alias_comuna'=>'Palena', 'codigo_comuna'=>'10404', 'estado_comuna'=>'', 'provincia_id'=>42],
            ['nombre_comuna'=>'Coyhaique', 'alias_comuna'=>'Coyhaique', 'codigo_comuna'=>'11101', 'estado_comuna'=>'', 'provincia_id'=>43],
            ['nombre_comuna'=>'Lago Verde', 'alias_comuna'=>'Lago Verde', 'codigo_comuna'=>'11102', 'estado_comuna'=>'', 'provincia_id'=>43],
            ['nombre_comuna'=>'Aysén', 'alias_comuna'=>'Aysén', 'codigo_comuna'=>'11201', 'estado_comuna'=>'', 'provincia_id'=>44],
            ['nombre_comuna'=>'Cisnes', 'alias_comuna'=>'Cisnes', 'codigo_comuna'=>'11202', 'estado_comuna'=>'', 'provincia_id'=>44],
            ['nombre_comuna'=>'Guaitecas', 'alias_comuna'=>'Guaitecas', 'codigo_comuna'=>'11203', 'estado_comuna'=>'', 'provincia_id'=>44],
            ['nombre_comuna'=>'Cochrane', 'alias_comuna'=>'Cochrane', 'codigo_comuna'=>'11301', 'estado_comuna'=>'', 'provincia_id'=>45],
            ['nombre_comuna'=>'OHiggins', 'alias_comuna'=>'OHiggins', 'codigo_comuna'=>'11302', 'estado_comuna'=>'', 'provincia_id'=>45],
            ['nombre_comuna'=>'Tortel', 'alias_comuna'=>'Tortel', 'codigo_comuna'=>'11303', 'estado_comuna'=>'', 'provincia_id'=>45],
            ['nombre_comuna'=>'Chile Chico', 'alias_comuna'=>'Chile Chico', 'codigo_comuna'=>'11401', 'estado_comuna'=>'', 'provincia_id'=>46],
            ['nombre_comuna'=>'Río Ibáñez', 'alias_comuna'=>'Río Ibáñez', 'codigo_comuna'=>'11402', 'estado_comuna'=>'', 'provincia_id'=>46],
            ['nombre_comuna'=>'Punta Arenas', 'alias_comuna'=>'Punta Arenas', 'codigo_comuna'=>'12101', 'estado_comuna'=>'', 'provincia_id'=>47],
            ['nombre_comuna'=>'Laguna Blanca', 'alias_comuna'=>'Laguna Blanca', 'codigo_comuna'=>'12102', 'estado_comuna'=>'', 'provincia_id'=>47],
            ['nombre_comuna'=>'Río Verde', 'alias_comuna'=>'Río Verde', 'codigo_comuna'=>'12103', 'estado_comuna'=>'', 'provincia_id'=>47],
            ['nombre_comuna'=>'San Gregorio', 'alias_comuna'=>'San Gregorio', 'codigo_comuna'=>'12104', 'estado_comuna'=>'', 'provincia_id'=>47],
            ['nombre_comuna'=>'Cabo de Hornos', 'alias_comuna'=>'Cabo de Hornos', 'codigo_comuna'=>'12201', 'estado_comuna'=>'', 'provincia_id'=>48],
            ['nombre_comuna'=>'Antártica', 'alias_comuna'=>'Antártica', 'codigo_comuna'=>'12202', 'estado_comuna'=>'', 'provincia_id'=>48],
            ['nombre_comuna'=>'Porvenir', 'alias_comuna'=>'Porvenir', 'codigo_comuna'=>'12301', 'estado_comuna'=>'', 'provincia_id'=>49],
            ['nombre_comuna'=>'Primavera', 'alias_comuna'=>'Primavera', 'codigo_comuna'=>'12302', 'estado_comuna'=>'', 'provincia_id'=>49],
            ['nombre_comuna'=>'Timaukel', 'alias_comuna'=>'Timaukel', 'codigo_comuna'=>'12303', 'estado_comuna'=>'', 'provincia_id'=>49],
            ['nombre_comuna'=>'Natales', 'alias_comuna'=>'Natales', 'codigo_comuna'=>'12401', 'estado_comuna'=>'', 'provincia_id'=>50],
            ['nombre_comuna'=>'Torres del Paine', 'alias_comuna'=>'Torres del Paine', 'codigo_comuna'=>'12402', 'estado_comuna'=>'', 'provincia_id'=>50],
            ['nombre_comuna'=>'Santiago', 'alias_comuna'=>'Santiago', 'codigo_comuna'=>'13101', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Cerrillos', 'alias_comuna'=>'Cerrillos', 'codigo_comuna'=>'13102', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Cerro Navia', 'alias_comuna'=>'Cerro Navia', 'codigo_comuna'=>'13103', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Conchalí', 'alias_comuna'=>'Conchalí', 'codigo_comuna'=>'13104', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'El Bosque', 'alias_comuna'=>'El Bosque', 'codigo_comuna'=>'13105', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Estación Central', 'alias_comuna'=>'Estación Central', 'codigo_comuna'=>'13106', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Huechuraba', 'alias_comuna'=>'Huechuraba', 'codigo_comuna'=>'13107', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Independencia', 'alias_comuna'=>'Independencia', 'codigo_comuna'=>'13108', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'La Cisterna', 'alias_comuna'=>'La Cisterna', 'codigo_comuna'=>'13109', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'La Florida', 'alias_comuna'=>'La Florida', 'codigo_comuna'=>'13110', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'La Granja', 'alias_comuna'=>'La Granja', 'codigo_comuna'=>'13111', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'La Pintana', 'alias_comuna'=>'La Pintana', 'codigo_comuna'=>'13112', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'La Reina', 'alias_comuna'=>'La Reina', 'codigo_comuna'=>'13113', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Las Condes', 'alias_comuna'=>'Las Condes', 'codigo_comuna'=>'13114', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Lo Barnechea', 'alias_comuna'=>'Lo Barnechea', 'codigo_comuna'=>'13115', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Lo Espejo', 'alias_comuna'=>'Lo Espejo', 'codigo_comuna'=>'13116', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Lo Prado', 'alias_comuna'=>'Lo Prado', 'codigo_comuna'=>'13117', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Macul', 'alias_comuna'=>'Macul', 'codigo_comuna'=>'13118', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Maipú', 'alias_comuna'=>'Maipú', 'codigo_comuna'=>'13119', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Ñuñoa', 'alias_comuna'=>'Ñuñoa', 'codigo_comuna'=>'13120', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Pedro Aguirre Cerda', 'alias_comuna'=>'Pedro Aguirre Cerda', 'codigo_comuna'=>'13121', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Peñalolén', 'alias_comuna'=>'Peñalolén', 'codigo_comuna'=>'13122', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Providencia', 'alias_comuna'=>'Providencia', 'codigo_comuna'=>'13123', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Pudahuel', 'alias_comuna'=>'Pudahuel', 'codigo_comuna'=>'13124', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Quilicura', 'alias_comuna'=>'Quilicura', 'codigo_comuna'=>'13125', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Quinta Normal', 'alias_comuna'=>'Quinta Normal', 'codigo_comuna'=>'13126', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Recoleta', 'alias_comuna'=>'Recoleta', 'codigo_comuna'=>'13127', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Renca', 'alias_comuna'=>'Renca', 'codigo_comuna'=>'13128', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'San Joaquín', 'alias_comuna'=>'San Joaquín', 'codigo_comuna'=>'13129', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'San Miguel', 'alias_comuna'=>'San Miguel', 'codigo_comuna'=>'13130', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'San Ramón', 'alias_comuna'=>'San Ramón', 'codigo_comuna'=>'13131', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Vitacura', 'alias_comuna'=>'Vitacura', 'codigo_comuna'=>'13132', 'estado_comuna'=>'', 'provincia_id'=>51],
            ['nombre_comuna'=>'Puente Alto', 'alias_comuna'=>'Puente Alto', 'codigo_comuna'=>'13201', 'estado_comuna'=>'', 'provincia_id'=>52],
            ['nombre_comuna'=>'Pirque', 'alias_comuna'=>'Pirque', 'codigo_comuna'=>'13202', 'estado_comuna'=>'', 'provincia_id'=>52],
            ['nombre_comuna'=>'San José de Maipo', 'alias_comuna'=>'San José de Maipo', 'codigo_comuna'=>'13203', 'estado_comuna'=>'', 'provincia_id'=>52],
            ['nombre_comuna'=>'Colina', 'alias_comuna'=>'Colina', 'codigo_comuna'=>'13301', 'estado_comuna'=>'', 'provincia_id'=>53],
            ['nombre_comuna'=>'Lampa', 'alias_comuna'=>'Lampa', 'codigo_comuna'=>'13302', 'estado_comuna'=>'', 'provincia_id'=>53],
            ['nombre_comuna'=>'Til Til', 'alias_comuna'=>'Til Til', 'codigo_comuna'=>'13303', 'estado_comuna'=>'', 'provincia_id'=>53],
            ['nombre_comuna'=>'San Bernardo', 'alias_comuna'=>'San Bernardo', 'codigo_comuna'=>'13401', 'estado_comuna'=>'', 'provincia_id'=>54],
            ['nombre_comuna'=>'Buin', 'alias_comuna'=>'Buin', 'codigo_comuna'=>'13402', 'estado_comuna'=>'', 'provincia_id'=>54],
            ['nombre_comuna'=>'Calera de Tango', 'alias_comuna'=>'Calera de Tango', 'codigo_comuna'=>'13403', 'estado_comuna'=>'', 'provincia_id'=>54],
            ['nombre_comuna'=>'Paine', 'alias_comuna'=>'Paine', 'codigo_comuna'=>'13404', 'estado_comuna'=>'', 'provincia_id'=>54],
            ['nombre_comuna'=>'Melipilla', 'alias_comuna'=>'Melipilla', 'codigo_comuna'=>'13501', 'estado_comuna'=>'', 'provincia_id'=>55],
            ['nombre_comuna'=>'Alhué', 'alias_comuna'=>'Alhué', 'codigo_comuna'=>'13502', 'estado_comuna'=>'', 'provincia_id'=>55],
            ['nombre_comuna'=>'Curacaví', 'alias_comuna'=>'Curacaví', 'codigo_comuna'=>'13503', 'estado_comuna'=>'', 'provincia_id'=>55],
            ['nombre_comuna'=>'María Pinto', 'alias_comuna'=>'María Pinto', 'codigo_comuna'=>'13504', 'estado_comuna'=>'', 'provincia_id'=>55],
            ['nombre_comuna'=>'San Pedro', 'alias_comuna'=>'San Pedro', 'codigo_comuna'=>'13505', 'estado_comuna'=>'', 'provincia_id'=>55],
            ['nombre_comuna'=>'Talagante', 'alias_comuna'=>'Talagante', 'codigo_comuna'=>'13601', 'estado_comuna'=>'', 'provincia_id'=>56],
            ['nombre_comuna'=>'El Monte', 'alias_comuna'=>'El Monte', 'codigo_comuna'=>'13602', 'estado_comuna'=>'', 'provincia_id'=>56],
            ['nombre_comuna'=>'Isla de Maipo', 'alias_comuna'=>'Isla de Maipo', 'codigo_comuna'=>'13603', 'estado_comuna'=>'', 'provincia_id'=>56],
            ['nombre_comuna'=>'Padre Hurtado', 'alias_comuna'=>'Padre Hurtado', 'codigo_comuna'=>'13604', 'estado_comuna'=>'', 'provincia_id'=>56],
            ['nombre_comuna'=>'Peñaflor', 'alias_comuna'=>'Peñaflor', 'codigo_comuna'=>'13605', 'estado_comuna'=>'', 'provincia_id'=>56]
        ];
        DB::table("comunas")->insert($data_comunas);
        //fin datos prueba
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
