<?php

namespace App\Providers;

use App\Models\PeriodoRegion;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('rut', function ($attribute, $value, $parameters, $validator) {
            $rut = $value;
            //return $value == 'foo';
            if (!preg_match("/^[0-9.]+[-]?+[0-9kK]{1}/", $rut)) {
                return false;
            }
            $rut = preg_replace('/[\.\-]/i', '', $rut);
            $dv = substr($rut, -1);
            $numero = substr($rut, 0, strlen($rut) - 1);
            $i = 2;
            $suma = 0;
            foreach (array_reverse(str_split($numero)) as $v) {
                if ($i == 8)
                    $i = 2;
                $suma += $v * $i;
                ++$i;
            }
            $dvr = 11 - ($suma % 11);
            if ($dvr == 11)
                $dvr = 0;
            if ($dvr == 10)
                $dvr = 'K';
            if ($dvr == strtoupper($dv))
                return true;
            else
                return false;
        });

        Validator::extend('valid_regiones', function($attribute, $value, $parameters, $validator){

            if ($parameters[0] != null && $parameters[1] != null) {
                $periodo_region = PeriodoRegion::join('periodo','periodo_region.periodo_id','=','periodo.periodo_id')
                    ->where('periodo.tipo_periodo_id','=', $parameters[0])
                    ->where('anyo','=', $parameters[1])
                    ->whereIn( 'region_id', $value )->count();

                return ( $periodo_region > 0 ) ? false : true;
            } else return false;
        });
    }

}
