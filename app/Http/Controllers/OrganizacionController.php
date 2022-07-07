<?php

namespace App\Http\Controllers;
use App\Models\Organizacion;
use App\Models\Representante;

use Illuminate\Http\Request;

class OrganizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizaciones = Organizacion::with([ 'comuna'])->paginate(5);
        //return $organizaciones;
        return view('organizaciones.index', ['organizaciones' => $organizaciones] );
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
        $organizacion = Organizacion::with('comuna')->find($id);
        $representantes = Representante::all()->where('organizacion_id','=', $id);
        //return $representante;
        return view('organizaciones.detalle', ['organizacion' => $organizacion, 'representantes'=> $representantes] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organizacion = Organizacion::find($id);
        $representantes = Representante::all()->where('organizacion_id','=', $id);

        return view('organizaciones.editar', ['organizacion' => $organizacion, 'representantes'=> $representantes] );
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
        $request -> validate([
            'nombre_organizacion'=>'required|min:3',
            'correo_organizacion'=>'required|email',
            'telefono_organizacion'=>'required|digits:9'
        ]);
        $organizacion_editar = Organizacion::find($id);
        $organizacion_editar->nombre_organizacion = $request->nombre_organizacion;
        $organizacion_editar->correo_organizacion = $request->correo_organizacion;
        $organizacion_editar->telefono_organizacion = $request->telefono_organizacion;
        $organizacion_editar->comuna_id = $request->comuna_id;
        $organizacion_editar->save();
        return redirect()->route('organizacion.show', ['organizacion'=>$id])->with('success', 'Organización actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organizacion_eliminar = Organizacion::find($id);
        $organizacion_eliminar->delete();

        return redirect()->route('organizacion.index')->with('success', 'Organización borrada');
    }
}
