<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viaje;
use App\Models\Postulacion;
use App\Models\Organizacion;
use App\Models\User;
use App\Models\Pasajero;
use Illuminate\Support\Facades\Auth;

class ViajesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();
        $organizacion = Organizacion::with('postulacion')->where('user_id', '=', $user)->first();
        $postulacion = Postulacion::with(['periodo.calendario'])->where('organizacion_id', '=', $organizacion->id)->first();
        $calendario_id = $postulacion->periodo->calendario->id;

        $viajes = Viaje::with('postulacion', 'calendarios')->where('viaje_asignado', '=', 0)->where('calendario_id', '=', $calendario_id)->get();

        //return $viajes;

        return view('viajes.index', ['viajes'=>$viajes, 'postulacion'=> $postulacion]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::id();
        $organizacion = Organizacion::with('postulacion')->where('user_id', '=', $user)->first();
        $postulacion = Postulacion::with(['periodo.calendario'])->where('organizacion_id', '=', $organizacion->id)->first();
        $calendario_id = $postulacion->periodo->calendario->id;

        $viaje = Viaje::with('postulacion', 'calendarios')->find($id);

        $pasajeros = Pasajero::where('viaje_id', '=', $viaje->id)->get();

        //return $pasajeros;

        return view('viajes.detalle', ['organizacion'=>$organizacion, 'viaje'=> $viaje, 'pasajeros'=> $pasajeros]);
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
        $viaje_eliminar = Viaje::find($id);
        $viaje_eliminar->delete();

        return redirect()->back()->with('success', 'Viaje Eliminado');
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
