<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periodo;
use App\Models\Region;
use App\Models\TipoPeriodo;
use App\Models\EstadoPeriodo;
use App\Models\PeriodoRegion;
use Illuminate\Support\Facades\DB;

class PeriodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodos = Periodo::with([ 'estado_periodos', 'tipo_periodos', 'region'])->paginate(8);
        /* $periodos = DB::table('periodos')
        ->join('estado_periodos','periodos.estado_periodos_id','=', 'estado_periodos.id')
        ->join('regiones', 'periodos.region_id', '=', 'regiones.id')
        ->select('periodos.*','nombre_estado', 'nombre_region')
        ->get(); */
        
        //return ($periodos);
        return view('periodos.index', ['periodos' => $periodos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estado_periodo = EstadoPeriodo::all();
        //$regiones = DB::table('regiones')->select('*')->get();
        $regiones = Region::all();
        $tipo_periodo = TipoPeriodo::all();

        return view('periodos.formulario', ['estado_periodo'=> $estado_periodo, 'regiones'=>$regiones, 'tipo_periodo'=> $tipo_periodo]);
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
            'descripcion'=>'required|min:3',
            'fecha_inicio'=>'required|date',
            'fecha_fin'=>'required|date|after:fecha_inicio',
            'tipo_periodos'=>'required'
        ]);
        $nuevo_periodo = new Periodo;
        $nuevo_periodo->descripcion = $request->descripcion;
        $nuevo_periodo->tipo_periodos_id = $request->tipo_periodos;
        $nuevo_periodo->estado_periodos_id = $request->estado_nombre;
        $nuevo_periodo->fecha_inicio = $request->fecha_inicio;
        $nuevo_periodo->fecha_fin = $request->fecha_fin;
        $nuevo_periodo->tipo_periodos_id = $request->tipo_periodos;
        $nuevo_periodo->save();
        $id_periodo_creado = $nuevo_periodo->id;
        if ($request->regiones){
            foreach($request->regiones as $region){
                $nuevo_periodo_region = new PeriodoRegion;
                $nuevo_periodo_region->periodo_id = $id_periodo_creado;
                $nuevo_periodo_region->region_id = $region;
                $nuevo_periodo_region->save();
            }
        }

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
        //$periodo_seleccionado = Periodo::find($id);
        $periodo_seleccionado = DB::table('periodos')
        ->join('estado_periodos','periodos.estado_periodos_id','=', 'estado_periodos.id')
        ->join('tipo_periodos', 'periodos.tipo_periodos_id', '=', 'tipo_periodos.id')
        ->select('periodos.*','nombre_estado', 'nombre_tipo_periodo')
        ->where('periodos.id','=', $id)
        ->first();
        $estado_periodo = EstadoPeriodo::all();
        $regiones = Region::all();
        $regiones_periodo = Periodo::find($id)->region()->get(); 
        $tipo_periodo = TipoPeriodo::all();

        //return [$regiones_periodo];
        return view('periodos.editar_formulario',['periodo'=> $periodo_seleccionado, 'estado_periodo'=>$estado_periodo, 'regiones'=>$regiones, 'tipo_periodo'=> $tipo_periodo, 'regiones_periodo'=> $regiones_periodo]);
    }

   /*  {
        $periodo_seleccionado = Periodo::find($id);
        $estado_periodo = EstadoPeriodo::all();
        return $periodo_seleccionado;
        //return view('periodos.editar_formulario', ['periodo'=> $periodo_seleccionado, 'estado_periodo'=> $estado_periodo]);
    } */



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
        //return $request->regiones;
        $request -> validate([
            'descripcion'=>'required|min:3',
            'fecha_inicio'=>'required|date',
            'fecha_fin'=>'required|date|after:fecha_inicio',
            'tipo_periodos'=>'required'
        ]);
        $periodo_a_editar = Periodo::find($id);
        $periodo_a_editar->descripcion = $request->descripcion;
        $periodo_a_editar->estado_periodos_id = $request->estado_nombre;
        $periodo_a_editar->fecha_inicio = $request->fecha_inicio;
        $periodo_a_editar->fecha_fin = $request->fecha_fin;
        $periodo_a_editar->tipo_periodos_id = $request->tipo_periodos;
        $periodo_a_editar->save();

        $periodos_regiones_delete = PeriodoRegion::where('periodo_id','=',$id)->get();
            foreach ($periodos_regiones_delete as $periodo_region_delete){
                $periodo_region_delete->delete();
            }
        if ($request->regiones){
            
            foreach($request->regiones as $region){
                $nuevo_periodo_region = new PeriodoRegion;
                $nuevo_periodo_region->periodo_id = $id;
                $nuevo_periodo_region->region_id = $region;
                $nuevo_periodo_region->save();
            }
        }
        

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
        try {
            $periodo_a_borrar = Periodo::find($id);
            $periodo_a_borrar->delete();
    
            return redirect()->route('periodos')->with('success', 'Periodo borrado');

        } catch (\Illuminate\Database\QueryException $e){
            //return $e->getMessage();
            return redirect()->back()->with('fail', 'No se puede eliminar el periodo seleccionado');
        }

    }

}
