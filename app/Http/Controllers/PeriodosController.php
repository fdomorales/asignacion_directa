<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periodo;

class PeriodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodos = Periodo::all();
        return view('periodos.index', ['periodos' => $periodos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('periodos.formulario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'descripcion'=>'required|min:3'
        ]);
        $nuevo_periodo = new Periodo;
        $nuevo_periodo->descripcion = $request->descripcion;
        $nuevo_periodo->region = $request->region;
        $nuevo_periodo->estado = $request->estado;
        $nuevo_periodo->fecha_inicio = $request->fecha_inicio;
        $nuevo_periodo->fecha_fin = $request->fecha_fin;
        $nuevo_periodo->save();

        return redirect()->route('periodos')->with('success', 'Periodo creado');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $periodo_seleccionado = Periodo::find($id);

        return view('periodos.editar_formulario', ['periodo'=> $periodo_seleccionado]);
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
        $periodo_a_editar = Periodo::find($id);
        $periodo_a_editar->descripcion = $request->descripcion;
        $periodo_a_editar->region = $request->region;
        $periodo_a_editar->estado = $request->estado;
        $periodo_a_editar->fecha_inicio = $request->fecha_inicio;
        $periodo_a_editar->fecha_fin = $request->fecha_fin;
        $periodo_a_editar->save();

        return redirect()->route('periodos')->with('success', 'Periodo actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periodo_a_borrar = Periodo::find($id);
        $periodo_a_borrar->delete();

        return redirect()->route('periodos')->with('success', 'Periodo borrado');
    }
}
