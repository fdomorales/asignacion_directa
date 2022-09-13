<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Viaje;
use App\Models\Postulacion;
use App\Models\Organizacion;
use App\Models\Calendario;
use App\Models\User;
use App\Models\Pasajero;
use App\Models\Periodo;
use App\Models\Region;
use App\Models\Provincia;
use App\Models\Comuna;
use Illuminate\Support\Facades\Auth;
use App\Exports\ViajesPasajerosExport;
use App\Exports\ViajesExports;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmaViaje;
use Excel;

class ViajesController extends Controller
{
    public function __construct()
    {
        //$this->middleware('can:viajes.index')->only('index');
        //$this->middleware('can:viajes.show')->only('show');
        $this->middleware('can:viajes.update')->only('update');
        $this->middleware('can:viajes.destroy')->only('destroy');
    }


    public function index()
    {
        if (auth()->user()->hasRole('Cliente')) {
            $organizacion = Organizacion::firstWhere('user_id', '=', auth()->user()->id);
            $postulacion = Postulacion::with(['periodo.calendario'])->firstWhere('organizacion_id', '=', $organizacion->id);

            // Agregado por aiturra
            if (is_null($postulacion)) return redirect()->route('index');

            $postulacion_has_viaje = $postulacion->viaje->count();
            $estado_viaje_asignado = 4;
            if ($postulacion_has_viaje == 0 && $postulacion->estado_postulacion_id == $estado_viaje_asignado){
                $has_viaje = true;
            }else{
                // TODO: No debe permitir el acceso cuando ya fue seleccionado el viaje. verificar que con esta condición sea suficiente
                // Agregado por aiturra
                abort('403');
                $has_viaje = false;
            }
            $calendario_id = $postulacion->periodo->calendario->id;
            $calendario_habilitado  = Calendario::find($calendario_id)->with('viajes')->where('estado_calendario', 1)->first();

            if ($calendario_habilitado){
                // TODO: Revissar si las siguientes consultas son equivalentes
                $viajes = Calendario::find($calendario_id)
                    ->with('viajes')
                    ->where('estado_calendario', 1)
                    ->first()
                    ->viajes
                    ->where('viaje_asignado',0);

                // Modificadio por aiturra
                /*$viajes = Viaje::query()
                    ->where('viaje_asignado',0)
                    ->whereHas('calendarios', function($q) use($calendario_id) {
                        $q->where('estado_calendario', 1)
                          ->where('id', $calendario_id);
                    })->get();
                */

            } else {
                $viajes = [];
            }

            return view('viajes.usuario.index', ['viajes'=>$viajes, 'postulacion'=> $postulacion, 'has_viaje'=> $has_viaje]);
        }else{
            $viajes = Viaje::with('postulacion.periodo', 'postulacion.organizacion', 'pasajeros', 'calendarios.periodo')->paginate(15);

            return view('viajes.index', ['viajes'=> $viajes]);
        }
    }


    public function store(Request $request)
    {
        $viaje = new Viaje;
        $viaje->origen_viaje = $request->origen_viaje;
        $viaje->destino_viaje = $request->destino_viaje;
        $viaje->inicio_viaje = $request->fecha_inicio;
        $viaje->fin_viaje = $request->fecha_fin;
        $viaje->periodo_viaje = $request->periodo_viaje;
        $viaje->cupo_baja_viaje = $request->cupo_viaje;
        $viaje->temporada_viaje = $request->temporada_viaje;
        $viaje->copago_viaje = $request->copago_viaje;
        $viaje->estado_viaje = 1;
        $viaje->viaje_asignado = 0;
        $viaje->calendario_id = $request->calendario_id;
        $viaje->save();

        return redirect()->back()->with('success', 'Viaje creado');
    }


    public function show($id)
    {
        
        $viajeIdByViajeAndUser = Viaje::getIdViajeByViajeAndUser($id);

        if ((is_null($viajeIdByViajeAndUser) || $viajeIdByViajeAndUser != $id) && auth()->user()->hasRole('Cliente')) {
            abort('403');
        }

        $regiones = Region::with('provincia.comuna')->get();
        $provincias = Provincia::all();
        $comunas = Comuna::all();

        $viaje = Viaje::with('postulacion.periodo', 'postulacion.organizacion', 'pasajeros', 'calendarios.periodo')->find($id);
        $organizacion = [];
        if($viaje->postulacion){
            $organizacion = $viaje->postulacion->organizacion;
        }

        $pasajeros = Pasajero::with('comuna.provincia.region')->where('viaje_id', '=', $viaje->id)->get();

        return view('viajes.usuario.detalle', ['organizacion'=>$organizacion, 'viaje'=> $viaje, 'pasajeros'=> $pasajeros, 'regiones'=> $regiones, 'provincias'=>$provincias, 'comunas'=>$comunas]);
    }


    public function update(Request $request, $id)
    {
        $viaje = Viaje::find($id);
        $viaje->origen_viaje = $request->origen;
        $viaje->destino_viaje = $request->destino;
        $viaje->inicio_viaje = $request->fecha_inicio;
        $viaje->fin_viaje = $request->fecha_fin;
        $viaje->periodo_viaje = $request->periodo_viaje;
        $viaje->cupo_baja_viaje = $request->cupo_viaje;
        $viaje->temporada_viaje = $request->temporada_viaje;
        $viaje->copago_viaje = $request->copago_viaje;
        $viaje->save();

        return redirect()->back()->with('success', 'Viaje actualizado');
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $viaje_eliminar = Viaje::find($id);
            $viaje_eliminar->delete();

            // TODO: Al eliminar el viaje se debe eliminar los pasajeros asociados al viaje.

        } catch (\Illuminate\Database\QueryException $e){
            DB::rollback();
            //return $e->getMessage();
            return redirect()->back()->with('fail', 'No se puede eliminar el viaje');
        }
        
        DB::commit();
        
        return redirect()->back()->with('success', 'Viaje Eliminado');
    }
    

    public function set_assignment(Request $request, $id)
    {
        //TODO: Validar que un usuario pueda seleccionar sólo un viaje. Al retroceder en el navegador y volver a seleccionar un viaje este no lo guarde en la bbdd y arroje mensaje personalizado.
        /*
        * Obtener el periodo del viaje
        * De acuerdo al viaje obtener el periodo
        */

        $periodoId = Periodo::getIdPeriodoByViajeAndUser($id);

        if (is_null($periodoId)) {
            // TODO: Personalizar mensaje cuando se ingresa a la URL y no existe un periodo activo
            abort('403');
        }

        $cantidadViajesSeleccionados = Viaje::getCantidadViajesPeriodo($periodoId);

        if ($cantidadViajesSeleccionados > 0) {
            // TODO: Incluir redirect a un mensaje personalizado que indique ya fue tomando un viaje.
            abort('403');
        }

        // Agregado por aiturra
        $postulacion = Postulacion::getPostulacionByPeriodoId($periodoId);

        $correo_organizacion = $postulacion->organizacion->correo_organizacion;

        // Agregado por aiturra
        DB::beginTransaction();

        try {
            $viaje = Viaje::find($id);
            $viaje->viaje_asignado = true;
            $viaje->postulacion_id = $postulacion->id;
            $viaje->save();

            $correo = new ConfirmaViaje($viaje);
            Mail::to($correo_organizacion)->send($correo);

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            // TODO: Agregar error personalizado
            // abort('403');
        }

        DB::commit();

        return redirect()->route('index_customer')->with('success', 'Viaje confirmado');
    }


    public function descargarListadoPasajeros (){
        return Excel::download(new ViajesPasajerosExport(), 'viajes_pasajeros.xlsx');
    }


    public function descargarListadoViajes(){

        return Excel::download(new ViajesExports(), 'viajes.xlsx');
    }
}
