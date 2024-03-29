<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeriodosController;
use App\Http\Controllers\PostulacionController;
use App\Http\Controllers\OrganizacionController;
use App\Http\Controllers\RepresentanteController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\ViajesController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ComunaController;
use App\Http\Controllers\PasajeroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;


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

//Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('index');
Route::get('/', [HomeController::class, 'index'])->name('index');
/*Route::get('/', function () {
    return view('index');
});*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/periodos', [PeriodosController::class, 'index'])->middleware(['auth', 'verified', 'can:periodos.index'])->name('periodos');
Route::get('/periodos/nuevo', [PeriodosController::class, 'create'])->middleware(['auth', 'verified', 'can:periodos.create'])->name('crear_periodos');
Route::post('/periodos', [PeriodosController::class, 'store'])->middleware(['auth', 'verified', 'can:periodos.store'])->name('periodos');
Route::get('/periodos/{id}', [PeriodosController::class, 'show'])->middleware(['auth', 'verified', 'can:periodos.show'])->name('ver_periodo');
Route::patch('/periodos/{id}', [PeriodosController::class, 'update'])->middleware(['auth', 'verified', 'can:periodos.update'])->name('actualizar_periodo');
Route::delete('/periodos/{id}', [PeriodosController::class, 'destroy'])->middleware(['auth', 'verified', 'can:periodos.destroy'])->name('borrar_periodo');

Route::resources(['postulacion'=> PostulacionController::class],  ['middleware' => ['auth', 'verified']]);
Route::patch('postulacion/acepta/{id}', [PostulacionController::class, 'aceptaPostulacion'])->middleware(['auth', 'verified', 'can:postulaciones.aceptaPostulacion'])->name('aceptar_postulacion');
Route::patch('postulacion/rechaza/{id}', [PostulacionController::class, 'rechazaPostulacion'])->middleware(['auth', 'verified', 'can:postulaciones.rechazaPostulacion'])->name('rechazar_postulacion');
Route::patch('postulacion/asigna/{id}', [PostulacionController::class, 'asignarViajesPostulacion'])->middleware(['auth', 'verified', 'can:postulaciones.asignarViajesPostulacion'])->name('asigna_viajes_postulacion');
Route::get('/descarga', [PostulacionController::class, 'downloadPostulaciones'])->middleware(['auth', 'verified'])->name('descargar_postulaciones');
Route::get('/descarga/{id}', [PostulacionController::class, 'downloadPDFPostulacion'])->middleware(['auth', 'verified'])->name('descarga_postulacion');
Route::get('postulacion/documento/{token}', [PostulacionController::class, 'getDocument'])->middleware(['auth', 'verified'])->name('postulacion_documento');
Route::get('/sendmail', [EmailController::class, 'enviarNotificacionPostulacion'])->middleware(['auth', 'verified'])->name('mailPostulacion');
Route::patch('/terminar/{id}', [PostulacionController::class, 'terminarCarga'])->middleware(['auth', 'verified' ])->name('terminar_carga');

Route::get('/usuario', [PostulacionController::class, 'index_customer'])->middleware(['auth', 'verified' , 'can:postulaciones.index_customer'])->name('index_customer');
Route::get('/usuario/postular', [PostulacionController::class, 'create_by_customer'])->middleware(['auth', 'verified' , 'can:postulaciones.create_by_customer'])->name('create_by_customer');
Route::post('/usuario/postular', [PostulacionController::class, 'store_by_customer'])->middleware(['auth', 'verified' , 'can:postulaciones.store_by_customer'])->name('store_by_customer');
Route::get('/usuario/postular/{id}', [PostulacionController::class, 'show_by_customer'])->middleware(['auth', 'verified' , 'can:postulaciones.show_by_customer'])->name('show_by_customer');
Route::patch('/usuario/postular/{id}', [PostulacionController::class, 'update_by_customer'])->middleware(['auth', 'verified' , 'can:postulaciones.update_by_customer'])->name('edit_by_customer');

Route::resources(['organizacion'=> OrganizacionController::class],  ['middleware' => ['auth', 'verified']]);
Route::get('/usuario/organizacion/{id}', [OrganizacionController::class, 'show_customer'])->middleware(['auth', 'verified', 'can:organizaciones.show_customer'])->name('show_customer');

Route::resources(['calendario'=> CalendarioController::class],  ['middleware' => ['auth', 'verified']]);
Route::post('/calendario/importar', [CalendarioController::class, 'insertTravels'])->middleware(['auth', 'verified', 'can:calendarios.insertTravels'])->name('insertar_excel');
Route::get('/exportar/{id}', [CalendarioController::class, 'downloadTravels'])->middleware(['auth', 'verified'])->name('descargar_calendario');

Route::resources(['representante'=> RepresentanteController::class],  ['middleware' => ['auth', 'verified']]);

Route::resources(['viaje'=> ViajesController::class],  ['middleware' => ['auth', 'verified']]);
Route::patch('/viaje/asignar/{id}', [ViajesController::class, 'set_assignment'])->middleware(['auth', 'verified', 'can:viajes.set_assignment'])->name('set_assignment');
Route::get('/descargaviaje', [ViajesController::class, 'descargarListadoViajes'])->middleware(['auth', 'verified'])->name('descargar_viajes');
Route::get('/descargapasajeros', [ViajesController::class, 'descargarListadoPasajeros'])->middleware(['auth', 'verified'])->name('descargar_pasajeros');

Route::resources(['pasajero'=> PasajeroController::class],  ['middleware' => ['auth', 'verified']]);
Route::patch('/eliminardocumento/{id}/{doc}', [PasajeroController::class, 'destroy_document'])->middleware(['auth', 'verified'])->name('destroy_document');
Route::get('/documento/{token}/{doc}', [PasajeroController::class, 'download_document'])->middleware(['auth', 'verified'])->name('download_document');
Route::get('/listado/{id}', [PasajeroController::class, 'download_list'])->middleware(['auth', 'verified'])->name('download_list');

Route::resources(['comunas'=> ComunaController::class],  ['middleware' => ['auth', 'verified']]);

Route::resources(['usuarios'=> UserController::class],  ['middleware' => ['auth', 'verified']]);


Route::get('/prueba', [PeriodosController::class, 'prueba']);



//Route::get('/postulacion/documento/{token}', 'PostulacionController@getDocument')->name('postulacion_documento');


