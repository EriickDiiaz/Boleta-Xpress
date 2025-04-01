<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use App\Models\Estudiante;
use App\Models\Asignatura;
use App\Models\AnoEscolar;
use Illuminate\Http\Request;

class BoletaController extends Controller
{
    public function index(Estudiante $estudiante)
    {
        $boletas = $estudiante->boletas()->with('anoEscolar')->orderBy('created_at', 'desc')->get();
        return view('boletas.index', compact('estudiante', 'boletas'));
    }

    public function create(Estudiante $estudiante)
    {
        $asignaturas = $estudiante->asignaturas;
        $anosEscolares = AnoEscolar::all(); // Asegúrate de que esto esté incluido
        return view('boletas.create', compact('estudiante', 'asignaturas', 'anosEscolares'));
    }

    public function store(Request $request, Estudiante $estudiante)
    {
        $validatedData = $this->validateBoleta($request);

        $boletaData = [
            'estudiante_id' => $estudiante->id,
            'escuela_id' => $estudiante->escuela_id,
            'grado_id' => $estudiante->grado_id,
            'seccion_id' => $estudiante->seccion_id,
            'ano_escolar_id' => $validatedData['ano_escolar_id'],
            'momento' => $validatedData['momento'],
            'tipo_boleta' => $validatedData['tipo_boleta'],
            'proyecto' => $validatedData['proyecto'],
            'observaciones' => $validatedData['observaciones'] ?? null,
        ];

        // Agregar calificación general si es 3er momento
        if ($validatedData['momento'] === '3er Momento') {
            if ($validatedData['tipo_boleta'] === 'calificativa' && 
                isset($validatedData['sistema_calificacion']) && 
                $validatedData['sistema_calificacion'] === 'numerica') {
                // Si es calificativa numérica, usar calificacion_general_numerica
                $boletaData['calificacion_general_numerica'] = $validatedData['calificacion_general_numerica'];
                $boletaData['calificacion_general'] = null; // Limpiar el otro campo
            } else {
                // Si es descriptiva o calificativa literal, usar calificacion_general
                $boletaData['calificacion_general'] = $validatedData['calificacion_general'];
                $boletaData['calificacion_general_numerica'] = null; // Limpiar el otro campo
            }
        }

        $boleta = Boleta::create($boletaData);

        foreach ($validatedData['calificaciones'] as $calificacion) {
            $boleta->calificacionesAsignaturas()->create($calificacion);
        }

        return redirect()->route('boletas.index', $estudiante)->with('mensaje', 'Boleta creada exitosamente.');
    }

    public function show(Estudiante $estudiante, Boleta $boleta)
    {
        return view('boletas.show', compact('estudiante', 'boleta'));
    }

    public function edit(Estudiante $estudiante, Boleta $boleta)
    {
        $asignaturas = $estudiante->asignaturas;
        $anosEscolares = AnoEscolar::orderBy('nombre', 'desc')->get();
        return view('boletas.edit', compact('estudiante', 'boleta', 'asignaturas', 'anosEscolares'));
    }

    public function update(Request $request, Estudiante $estudiante, Boleta $boleta)
    {
        $validatedData = $this->validateBoleta($request);

        $boletaData = [
            'momento' => $validatedData['momento'],
            'ano_escolar_id' => $validatedData['ano_escolar_id'],
            'tipo_boleta' => $validatedData['tipo_boleta'],
            'proyecto' => $validatedData['proyecto'],
            'observaciones' => $validatedData['observaciones'] ?? null,
        ];

        // Agregar calificación general si es 3er momento
        if ($validatedData['momento'] === '3er Momento') {
            if ($validatedData['tipo_boleta'] === 'calificativa' && 
                isset($validatedData['sistema_calificacion']) && 
                $validatedData['sistema_calificacion'] === 'numerica') {
                // Si es calificativa numérica, usar calificacion_general_numerica
                $boletaData['calificacion_general_numerica'] = $validatedData['calificacion_general_numerica'];
                $boletaData['calificacion_general'] = null; // Limpiar el otro campo
            } else {
                // Si es descriptiva o calificativa literal, usar calificacion_general
                $boletaData['calificacion_general'] = $validatedData['calificacion_general'];
                $boletaData['calificacion_general_numerica'] = null; // Limpiar el otro campo
            }
        } else {
            // Si no es 3er momento, limpiar ambos campos
            $boletaData['calificacion_general'] = null;
            $boletaData['calificacion_general_numerica'] = null;
        }

        $boleta->update($boletaData);

        foreach ($validatedData['calificaciones'] as $calificacion) {
            $boleta->calificacionesAsignaturas()->updateOrCreate(
                ['asignatura_id' => $calificacion['asignatura_id']],
                $calificacion
            );
        }

        return redirect()->route('boletas.index', $estudiante)->with('mensaje', 'Boleta actualizada exitosamente.');
    }

    public function destroy(Estudiante $estudiante, Boleta $boleta)
    {
        $boleta->delete();
        return redirect()->route('boletas.index', $estudiante)->with('success', 'Boleta eliminada exitosamente.');
    }

    public function setCalificacionFinal(Request $request, Estudiante $estudiante)
    {
        $validatedData = $request->validate([
            'ano_escolar_id' => 'required|exists:anos_escolares,id',
            'calificacion_general' => 'required|in:A,B,C,D,E',
        ]);

        $boletas = $estudiante->boletas()->where('ano_escolar_id', $validatedData['ano_escolar_id'])->get();
        
        foreach ($boletas as $boleta) {
            $boleta->update(['calificacion_general' => $validatedData['calificacion_general']]);
        }

        return redirect()->route('boletas.index', $estudiante)->with('success', 'Calificación final asignada exitosamente.');
    }

    private function validateBoleta(Request $request)
    {
        $rules = [
            'ano_escolar_id' => 'required|exists:anos_escolares,id',
            'momento' => 'required|in:1er Momento,2do Momento,3er Momento',
            'tipo_boleta' => 'required|in:descriptiva,calificativa',
            'proyecto' => 'required|string',
            'observaciones' => 'nullable|string',
            'calificaciones' => 'required|array',
            'calificaciones.*.asignatura_id' => 'required|exists:asignaturas,id',
        ];

        // Si es calificativa, validar el sistema de calificación
        if ($request->input('tipo_boleta') === 'calificativa') {
            $rules['sistema_calificacion'] = 'required|in:literal,numerica';
        }

        // Reglas específicas según el tipo de boleta
        if ($request->input('tipo_boleta') === 'descriptiva') {
            $rules['calificaciones.*.descripcion'] = 'nullable|string';
        } else {
            // Para boletas calificativas
            if ($request->input('sistema_calificacion') === 'literal') {
                $rules['calificaciones.*.calificacion_literal'] = 'nullable|in:A,B,C,D,E';
            } else {
                $rules['calificaciones.*.calificacion_numerica'] = 'nullable|numeric|min:0|max:20';
            }
        }

        // Validación para calificación general en el 3er momento
        if ($request->input('momento') === '3er Momento') {
            if ($request->input('tipo_boleta') === 'calificativa' && 
                $request->input('sistema_calificacion') === 'numerica') {
                $rules['calificacion_general_numerica'] = 'required|numeric|min:0|max:20';
            } else {
                $rules['calificacion_general'] = 'required|in:A,B,C,D,E';
            }
        }

        return $request->validate($rules, [
            'momento.required' => 'El campo Momento es obligatorio.',
            'momento.in' => 'El momento debe ser 1er Momento, 2do Momento o 3er Momento.',
            'proyecto.required' => 'El campo Nombre del Proyecto es obligatorio.',
            'ano_escolar_id.required' => 'El año escolar es obligatorio.',
            'ano_escolar_id.exists' => 'El año escolar seleccionado no existe.',
            'calificaciones.required' => 'Las calificaciones son obligatorias.',
            'calificaciones.*.asignatura_id.required' => 'El ID de la asignatura es obligatorio.',
            'calificaciones.*.asignatura_id.exists' => 'La asignatura seleccionada no existe.',
            'calificaciones.*.descripcion.required' => 'La descripción de la calificación es obligatoria.',
            'calificacion_general.required' => 'La calificación general es obligatoria para el 3er Momento.',
            'calificacion_general.in' => 'La calificación general debe ser A, B, C, D o E.',
            'calificacion_general_numerica.required' => 'La calificación general numérica es obligatoria para el 3er Momento.',
            'calificacion_general_numerica.numeric' => 'La calificación general numérica debe ser un número.',
            'calificacion_general_numerica.min' => 'La calificación general numérica debe ser al menos 0.',
            'calificacion_general_numerica.max' => 'La calificación general numérica no puede ser mayor a 20.',
            'tipo_boleta.required' => 'El tipo de boleta es obligatorio.',
            'tipo_boleta.in' => 'El tipo de boleta debe ser descriptiva o calificativa.',
            'sistema_calificacion.required' => 'El sistema de calificación es obligatorio para boletas calificativas.',
            'sistema_calificacion.in' => 'El sistema de calificación debe ser literal o numérica.',
            'calificaciones.*.descripcion.required' => 'La descripción de la calificación es obligatoria para boletas descriptivas.',
            'calificaciones.*.calificacion_literal.required' => 'La calificación literal es obligatoria para este tipo de boleta.',
            'calificaciones.*.calificacion_numerica.required' => 'La calificación numérica es obligatoria para este tipo de boleta.',
        ]);
    }
}