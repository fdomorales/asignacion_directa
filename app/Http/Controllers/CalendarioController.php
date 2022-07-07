<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periodo;
use App\Models\Calendario;
use App\Models\Viaje;
use Illuminate\Support\Facades\DB;
use App\Imports\CalendarioImport;
use App\Exports\ViajesExports;
use Excel;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendarios = Calendario::with(['periodo'])->paginate(5);
        return view('calendario.index', ['calendarios'=> $calendarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estado_periodo_habilitado = 1;
        $periodos = Periodo::all()->where('estado_periodos_id', $estado_periodo_habilitado);

        return view('calendario.crear', ['periodos'=> $periodos]);
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
        $calendario = Calendario::with(['periodo'])->find($id);
        //$viajes_calendario = Calendario::with(['viajes'])->find($id)->first()->viajes;
        $viajes_calendario = Viaje::where('calendario_id','=',$id)->get();
        //return $viajes_calendario;
        
        return view('calendario.editar', ['calendario'=> $calendario, 'viajes_calendario'=> $viajes_calendario]);
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
        $estado_procesado = 2;
        $calendario = Calendario::find($id);
        $calendario->estado_calendario = $estado_procesado;
        $calendario->save();
        return redirect()->route('calendario.index')->with('success', 'Calendario procesado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function insertTravels(Request $request)
    {
        $nuevo_calendario = new Calendario;
        $nuevo_calendario->estado_calendario = '1';
        $nuevo_calendario->periodo_id = $request->periodo;
        $nuevo_calendario->save();

        Excel::Import(new CalendarioImport($nuevo_calendario->id), request()->file('documento_viajes') );

        return redirect()->route('calendario.index')->with('success', 'Calendario creado');
    }

    public function downloadTravels($id){

        return Excel::download(new ViajesExports($id), 'calendario.xlsx');
    }
}
