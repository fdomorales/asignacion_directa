<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comuna;
use App\Models\Provincia;

class ComunaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:calendarios.index')->only('index');
        $this->middleware('can:calendarios.store')->only('store');
        $this->middleware('can:calendarios.update')->only('update');
        $this->middleware('can:calendarios.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comunas = Comuna::with('provincia.region')->get();
        $provincias = Provincia::all();

        //return $comunas;

        return view('comunas.index', ['comunas'=> $comunas, 'provincias'=>$provincias]);
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
        $comuna = new Comuna;
        $comuna->nombre_comuna = $request->nombre_comuna;
        $comuna->alias_comuna = $request->alias_comuna;
        $comuna->codigo_comuna = '';
        $comuna->estado_comuna = '';
        $comuna->provincia_id = $request->provincia;
        $comuna->save();
        
        return redirect()->back()->with('success', 'Comuna agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $comuna = Comuna::find($id);
        $comuna->nombre_comuna = $request->nombre_comuna;
        $comuna->alias_comuna = $request->alias_comuna;
        $comuna->save();

        return redirect()->back()->with('success', 'Comuna actualizada');
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
            $comuna = Comuna::find($id);
            $comuna->delete();
    
            return redirect()->back()->with('success', 'Comuna eliminada');

        } catch (\Illuminate\Database\QueryException $e){
            //return $e->getMessage();
            return redirect()->back()->with('fail', 'No se puede eliminar la comuna');
        }
    }
}
