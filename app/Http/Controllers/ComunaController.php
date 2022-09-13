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

    
    public function index()
    {
        $comunas = Comuna::with('provincia.region')->get();
        $provincias = Provincia::all();

        //return $comunas;

        return view('comunas.index', ['comunas'=> $comunas, 'provincias'=>$provincias]);
    }


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


    public function update(Request $request, $id)
    {
        $comuna = Comuna::find($id);
        $comuna->nombre_comuna = $request->nombre_comuna;
        $comuna->alias_comuna = $request->alias_comuna;
        $comuna->save();

        return redirect()->back()->with('success', 'Comuna actualizada');
    }


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
