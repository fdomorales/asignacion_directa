<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeriodosController;
use App\Http\Controllers\PostulacionController;

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

Route::get('/periodos', [PeriodosController::class, 'index'])->name('periodos');
Route::get('/periodos/nuevo', [PeriodosController::class, 'create'])->name('crear_periodos');
Route::post('/periodos', [PeriodosController::class, 'store'])->name('periodos');
Route::get('/periodos/{id}', [PeriodosController::class, 'show'])->name('ver_periodo');
Route::patch('/periodos/{id}', [PeriodosController::class, 'update'])->name('actualizar_periodo');
Route::delete('/periodos/{id}', [PeriodosController::class, 'destroy'])->name('borrar_periodo');

//Route::get('/postulacion', [PostulacionController::class, 'index']);
//Route::get('/postulacion/crear', [PostulacionController::class, 'create']);
Route::resources(['postulacion'=> PostulacionController::class]);

Route::get('postulacion/documento/{token}', [PostulacionController::class, 'getDocument'])->name('postulacion_documento');
//Route::get('/postulacion/documento/{token}', 'PostulacionController@getDocument')->name('postulacion_documento');