<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\PostulacionEnviada;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function enviarNotificacionPostulacion(Request $request){
        $correo = new PostulacionEnviada($request);
        Mail::to($request->email)->send($correo);

        return redirect()->route('index_customer')->with('success', 'Postulación correcta');
    }
}
