<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viaje;
use App\Models\Postulacion;
use App\Models\Organizacion;
use App\Models\Calendario;
use App\Models\User;
use App\Models\Pasajero;
use App\Models\Region;
use App\Models\Provincia;
use App\Models\Comuna;
use Illuminate\Support\Facades\Auth;

class ViajesController extends Controller
{
    public function __construct()
    {
        //$this->middleware('can:viajes.index')->only('index');
        //$this->middleware('can:viajes.show')->only('show');
        $this->middleware('can:viajes.update')->only('update');
        $this->middleware('can:viajes.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('Customer'))
        {
            $user_id = Auth::id();
            $organizacion = Organizacion::with('postulacion')->where('user_id', '=', $user_id)->first();
            $postulacion = Postulacion::with(['periodo.calendario'])->where('organizacion_id', '=', $organizacion->id)->first();
            $postulacion_has_viaje = $postulacion->viaje->count();
            $estado_viaje_asignado = 4;
            if ($postulacion_has_viaje == 0 && $postulacion->estado_postulacion_id == $estado_viaje_asignado){
                $has_viaje = true;
            }else{
                $has_viaje = false;
            }
            $calendario_id = $postulacion->periodo->calendario->id;
            $calendario_habilitado  = Calendario::find($calendario_id)->with('viajes')->where('estado_calendario', 1)->first();
            
            if ($calendario_habilitado){
                $viajes = Calendario::find($calendario_id)->with('viajes')->where('estado_calendario', 1)->first()->viajes;
                
            }else{
                $viajes = [];
            }
            
            return view('viajes.usuario.index', ['viajes'=>$viajes, 'postulacion'=> $postulacion, 'has_viaje'=> $has_viaje]);
        }else{

            $viajes = Viaje::with('postulacion.periodo', 'postulacion.organizacion', 'pasajeros', 'calendarios.periodo')->paginate(15);

            return view('viajes.index', ['viajes'=> $viajes]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $viaje_eliminar = Viaje::find($id);
            $viaje_eliminar->delete();
    
            return redirect()->back()->with('success', 'Viaje Eliminado');

        } catch (\Illuminate\Database\QueryException $e){
            //return $e->getMessage();
            return redirect()->back()->with('fail', 'No se puede eliminar el viaje');
        }
    }

    
    public function set_assignment(Request $request, $id)
    {
        
        $user = Auth::id();
        $organizacion = Organizacion::with('postulacion')->where('user_id', '=', $user)->first();
        $postulacion = Postulacion::where('organizacion_id', '=', $organizacion->id)->first();

        $viaje = Viaje::find($id);
        $viaje->viaje_asignado = true;
        $viaje->postulacion_id = $postulacion->id;
        //return $viaje;
        $viaje->save();

        return redirect()->route('index_customer')->with('success', 'Viaje confirmado');
    }
}
