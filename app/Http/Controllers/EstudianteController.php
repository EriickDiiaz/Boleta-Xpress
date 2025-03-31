<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Escuela;
use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Asignatura;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::with(['escuela', 'grado', 'seccion'])->get();
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        $escuelas = Escuela::all();
        $grados = Grado::all();
        $secciones = Seccion::all();
        $asignaturas = Asignatura::all();
        return view('estudiantes.create', compact('escuelas', 'grados', 'secciones', 'asignaturas'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateEstudiante($request);
        $estudiante = Estudiante::create($validatedData);
        $estudiante->asignaturas()->attach($request->asignaturas);
        return redirect()->route('estudiantes.index')->with('mensaje', 'Estudiante creado exitosamente.');
    }

    public function show($id)
    {
        $estudiante = Estudiante::with(['escuela', 'grado', 'seccion', 'asignaturas'])->findOrFail($id);
        return view('estudiantes.show', compact('estudiante'));
    }

    public function edit(Estudiante $estudiante)
    {
        $escuelas = Escuela::all();
        $grados = Grado::all();
        $secciones = Seccion::all();
        $asignaturas = Asignatura::all();
        
        // Convertir la fecha de nacimiento a un formato que el input date pueda manejar
        $estudiante->fecha_nacimiento = $estudiante->fecha_nacimiento ? Carbon::parse($estudiante->fecha_nacimiento)->format('Y-m-d') : null;

        return view('estudiantes.edit', compact('estudiante', 'escuelas', 'grados', 'secciones', 'asignaturas'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateEstudiante($request, $id);
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->update($validatedData);
        $estudiante->asignaturas()->sync($request->asignaturas);
        return redirect()->route('estudiantes.show', $estudiante->id)->with('mensaje', 'Estudiante actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->delete();
        return redirect()->route('estudiantes.index')->with('mensaje', 'Estudiante eliminado exitosamente.');
    }

    protected function validateEstudiante(Request $request, $id = null)
    {
        return $request->validate([
            'escuela_id' => 'required|exists:escuelas,id',
            'grado_id' => 'required|exists:grados,id',
            'seccion_id' => 'required|exists:secciones,id',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'genero' => 'nullable|in:Masculino,Femenino',
            'cedula' => ['required', 'string', 'max:20', Rule::unique('estudiantes')->ignore($id)],
            'fecha_nacimiento' => 'required|date',
            'lugar_nacimiento' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:255',
            'nombre_representante' => 'nullable|string|max:255',
            'cedula_representante' => 'nullable|string|max:20',
            'telefono_representante' => 'nullable|string|max:20',
            'correo_representante' => 'nullable|email|max:255',
            'asignaturas' => 'required|array',
            'asignaturas.*' => 'exists:asignaturas,id',
        ]);
    }
}