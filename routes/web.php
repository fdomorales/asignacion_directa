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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



Route::get('/periodos', [PeriodosController::class, 'index'])->middleware(['auth'])->name('periodos');
Route::get('/periodos/nuevo', [PeriodosController::class, 'create'])->middleware(['auth'])->name('crear_periodos');
Route::post('/periodos', [PeriodosController::class, 'store'])->middleware(['auth'])->name('periodos');
Route::get('/periodos/{id}', [PeriodosController::class, 'show'])->middleware(['auth'])->name('ver_periodo');
Route::patch('/periodos/{id}', [PeriodosController::class, 'update'])->middleware(['auth'])->name('actualizar_periodo');
Route::delete('/periodos/{id}', [PeriodosController::class, 'destroy'])->middleware(['auth'])->name('borrar_periodo');

//Route::get('/postulacion', [PostulacionController::class, 'index']);
//Route::get('/postulacion/crear', [PostulacionController::class, 'create']);
Route::resources(['postulacion'=> PostulacionController::class],  ['middleware' => 'auth']);

Route::get('postulacion/documento/{token}', [PostulacionController::class, 'getDocument'])->middleware(['auth'])->name('postulacion_documento');
//Route::get('/postulacion/documento/{token}', 'PostulacionController@getDocument')->name('postulacion_documento');

