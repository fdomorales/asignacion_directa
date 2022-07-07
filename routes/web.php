<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeriodosController;
use App\Http\Controllers\PostulacionController;
use App\Http\Controllers\OrganizacionController;
use App\Http\Controllers\RepresentanteController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\ViajesController;
use App\Http\Controllers\EmailController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('inicio');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';



Route::get('/periodos', [PeriodosController::class, 'index'])->middleware(['auth', 'verified'])->name('periodos');
Route::get('/periodos/nuevo', [PeriodosController::class, 'create'])->middleware(['auth', 'verified'])->name('crear_periodos');
Route::post('/periodos', [PeriodosController::class, 'store'])->middleware(['auth', 'verified'])->name('periodos');
Route::get('/periodos/{id}', [PeriodosController::class, 'show'])->middleware(['auth', 'verified'])->name('ver_periodo');
Route::patch('/periodos/{id}', [PeriodosController::class, 'update'])->middleware(['auth', 'verified'])->name('actualizar_periodo');
Route::delete('/periodos/{id}', [PeriodosController::class, 'destroy'])->middleware(['auth', 'verified'])->name('borrar_periodo');

Route::get('/periodosprueba', [PeriodosController::class, 'prueba'])->middleware(['auth', 'verified'])->name('prueba_periodo');


Route::resources(['postulacion'=> PostulacionController::class],  ['middleware' => ['auth', 'verified']]);
Route::patch('postulacion/acepta/{id}', [PostulacionController::class, 'aceptaPostulacion'])->middleware(['auth', 'verified'])->name('aceptar_postulacion');
Route::patch('postulacion/rechaza/{id}', [PostulacionController::class, 'rechazaPostulacion'])->middleware(['auth', 'verified'])->name('rechazar_postulacion');
Route::get('/descarga/{id}', [PostulacionController::class, 'downloadPostulacion'])->middleware(['auth', 'verified'])->name('descarga_postulacion');
Route::get('postulacion/documento/{token}', [PostulacionController::class, 'getDocument'])->middleware(['auth', 'verified'])->name('postulacion_documento');
Route::get('/sendmail', [EmailController::class, 'enviarNotificacionPostulacion'])->middleware(['auth', 'verified'])->name('mailPostulacion');

Route::resources(['organizacion'=> OrganizacionController::class],  ['middleware' => ['auth', 'verified']]);

Route::resources(['calendario'=> CalendarioController::class],  ['middleware' => ['auth', 'verified']]);
Route::post('/calendario/importar', [CalendarioController::class, 'insertTravels'])->middleware(['auth', 'verified'])->name('insertar_excel');
Route::get('/exportar/{id}', [CalendarioController::class, 'downloadTravels'])->middleware(['auth', 'verified'])->name('descargar_calendario');

Route::resources(['representante'=> RepresentanteController::class],  ['middleware' => ['auth', 'verified']]);

Route::resources(['viaje'=> ViajesController::class],  ['middleware' => ['auth', 'verified']]);


//Route::get('/postulacion/documento/{token}', 'PostulacionController@getDocument')->name('postulacion_documento');

