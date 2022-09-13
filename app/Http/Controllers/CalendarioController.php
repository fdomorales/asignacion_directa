<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periodo;
use App\Models\Calendario;
use App\Models\Viaje;
use Illuminate\Support\Facades\DB;
use App\Imports\CalendarioImport;
use App\Exports\ViajesCalendarioExports;
use Excel;

class CalendarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:calendarios.index')->only('index');
        $this->middleware('can:calendarios.create')->only('create');
        $this->middleware('can:calendarios.show')->only('show');
        $this->middleware('can:calendarios.update')->only('update');
    }

    
    public function index()
    {
        $calendarios = Calendario::with(['periodo'])->get();
        return view('calendario.index', ['calendarios'=> $calendarios]);
    }


    public function create()
    {
        $estado_periodo_habilitado = 1;
        $periodos = Periodo::with('calendario')->doesntHave('calendario')->where('estado_periodos_id', $estado_periodo_habilitado)->get();

        return view('calendario.crear', ['periodos'=> $periodos]);
    }


    public function show($id)
    {
        $calendario = Calendario::with(['periodo'])->find($id);
        $viajes_calendario = Viaje::where('calendario_id','=',$id)->get();

        return view('calendario.editar', ['calendario'=> $calendario, 'viajes_calendario'=> $viajes_calendario]);
    }


    public function update(Request $request, $id)
    {
        $estado_procesado = 1;
        $calendario = Calendario::find($id);
        $calendario->estado_calendario = $estado_procesado;
        $calendario->save();
        return redirect()->route('calendario.index')->with('success', 'Calendario procesado');
    }


    public function insertTravels(Request $request)
    {
        DB::beginTransaction();

        try{

            $nuevo_calendario = new Calendario;
            $nuevo_calendario->estado_calendario = 0;
            $nuevo_calendario->periodo_id = $request->periodo;
            $nuevo_calendario->save();
    
            Excel::Import(new CalendarioImport($nuevo_calendario->id), request()->file('documento_viajes') );

        } catch (\Exception $e) {
            DB::rollback();
			throw $e;
        }
        
        DB::commit();

        return redirect()->route('calendario.index')->with('success', 'Calendario creado');
    }


    public function downloadTravels($id){
        return Excel::download(new ViajesCalendarioExports($id), 'calendario.xlsx');
    }
}
