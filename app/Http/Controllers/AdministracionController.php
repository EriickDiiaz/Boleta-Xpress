<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Asignatura;
use App\Models\AnoEscolar;
use Illuminate\Http\Request;

class AdministracionController extends Controller
{
    public function index()
    {
        $grados = Grado::all();
        $secciones = Seccion::all();
        $asignaturas = Asignatura::all();
        $anos_escolares = AnoEscolar::all();
        return view('administracion.index', compact('grados', 'secciones', 'asignaturas', 'anos_escolares'));
    }

    // Métodos para Grados
    public function crearGrado(Request $request)
    {
        $request->validate(['nombre' => 'required|unique:grados,nombre']);
        Grado::create($request->all());
        return redirect()->route('administracion.index')->with('mensaje', 'Grado creado exitosamente.');
    }

    public function actualizarGrado(Request $request, Grado $grado)
    {
        $request->validate(['nombre' => 'required|unique:grados,nombre,' . $grado->id]);
        $grado->update($request->all());
        return redirect()->route('administracion.index')->with('mensaje', 'Grado actualizado exitosamente.');
    }

    public function eliminarGrado(Grado $grado)
    {
        $grado->delete();
        return redirect()->route('administracion.index')->with('mensaje', 'Grado eliminado exitosamente.');
    }

    // Métodos para Secciones
    public function crearSeccion(Request $request)
    {
        $request->validate(['nombre' => 'required|unique:secciones,nombre']);
        Seccion::create($request->all());
        return redirect()->route('administracion.index')->with('mensaje', 'Sección creada exitosamente.');
    }

    public function actualizarSeccion(Request $request, Seccion $seccion)
    {
        $request->validate(['nombre' => 'required|unique:secciones,nombre,' . $seccion->id]);
        $seccion->update($request->all());
        return redirect()->route('administracion.index')->with('mensaje', 'Sección actualizada exitosamente.');
    }

    public function eliminarSeccion(Seccion $seccion)
    {
        $seccion->delete();
        return redirect()->route('administracion.index')->with('mensaje', 'Sección eliminada exitosamente.');
    }

    // Métodos para Asignaturas
    public function crearAsignatura(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:asignaturas,nombre',
            'descripcion' => 'nullable'
        ]);
        Asignatura::create($request->all());
        return redirect()->route('administracion.index')->with('mensaje', 'Asignatura creada exitosamente.');
    }

    public function actualizarAsignatura(Request $request, Asignatura $asignatura)
    {
        $request->validate([
            'nombre' => 'required|unique:asignaturas,nombre,' . $asignatura->id,
            'descripcion' => 'nullable'
        ]);
        $asignatura->update($request->all());
        return redirect()->route('administracion.index')->with('mensaje', 'Asignatura actualizada exitosamente.');
    }

    public function eliminarAsignatura(Asignatura $asignatura)
    {
        $asignatura->delete();
        return redirect()->route('administracion.index')->with('mensaje', 'Asignatura eliminada exitosamente.');
    }

    // Métodos para Años Escolares
    public function crearAnoEscolar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|regex:/^\d{4}-\d{4}$/|unique:anos_escolares,nombre',
            'fecha_inicio' => 'nullable|string',
            'fecha_fin' => 'nullable|string',
        ]);
        AnoEscolar::create($request->all());
        return redirect()->route('administracion.index')->with('mensaje', 'Año Escolar creado exitosamente.');
    }

    public function actualizarAnoEscolar(Request $request, AnoEscolar $ano_escolar)
    {
        $request->validate([
            'nombre' => 'required|string|regex:/^\d{4}-\d{4}$/|unique:anos_escolares,nombre,' . $ano_escolar->id,
            'fecha_inicio' => 'nullable|string',
            'fecha_fin' => 'nullable|string',
        ]);
        $ano_escolar->update($request->all());
        return redirect()->route('administracion.index')->with('mensaje', 'Año Escolar actualizado exitosamente.');
    }

    public function eliminarAnoEscolar(AnoEscolar $ano_escolar)
    {
        $ano_escolar->delete();
        return redirect()->route('administracion.index')->with('mensaje', 'Año Escolar eliminado exitosamente.');
    }
}