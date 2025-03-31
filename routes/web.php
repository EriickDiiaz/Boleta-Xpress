<?php

use App\Http\Controllers\EscuelaController;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\EstudianteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false], ['reset' => false]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas protegidas (requieren autenticación)
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::resource('escuelas', EscuelaController::class);
    Route::resource('estudiantes', EstudianteController::class);

    Route::prefix('administracion')->group(function () {
        Route::get('/', [AdministracionController::class, 'index'])->name('administracion.index');
        
        // Rutas para Grados
        Route::post('/grados', [AdministracionController::class, 'crearGrado'])->name('grados.crear');
        Route::put('/grados/{grado}', [AdministracionController::class, 'actualizarGrado'])->name('grados.actualizar');
        Route::delete('/grados/{grado}', [AdministracionController::class, 'eliminarGrado'])->name('grados.eliminar');
        
        // Rutas para Secciones
        Route::post('/secciones', [AdministracionController::class, 'crearSeccion'])->name('secciones.crear');
        Route::put('/secciones/{seccion}', [AdministracionController::class, 'actualizarSeccion'])->name('secciones.actualizar');
        Route::delete('/secciones/{seccion}', [AdministracionController::class, 'eliminarSeccion'])->name('secciones.eliminar');
        
        // Rutas para Asignaturas
        Route::post('/asignaturas', [AdministracionController::class, 'crearAsignatura'])->name('asignaturas.crear');
        Route::put('/asignaturas/{asignatura}', [AdministracionController::class, 'actualizarAsignatura'])->name('asignaturas.actualizar');
        Route::delete('/asignaturas/{asignatura}', [AdministracionController::class, 'eliminarAsignatura'])->name('asignaturas.eliminar');
    
        // Rutas para Años Escolares
        Route::post('/anos_escolares', [AdministracionController::class, 'crearAnoEscolar'])->name('anos_escolares.crear');
        Route::put('/anos_escolares/{ano_escolar}', [AdministracionController::class, 'actualizarAnoEscolar'])->name('anos_escolares.actualizar');
        Route::delete('/anos_escolares/{ano_escolar}', [AdministracionController::class, 'eliminarAnoEscolar'])->name('anos_escolares.eliminar');
    });
    
});