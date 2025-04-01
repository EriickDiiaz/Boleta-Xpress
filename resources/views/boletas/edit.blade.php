@extends('layouts.app')

@section('title', 'Editar Boleta de ' . $estudiante->nombres . ' ' . $estudiante->apellidos)

@section('content')
<div class="container">
    <h2>
        <i class="fas fa-edit m-2"></i>
        Editar Boleta de {{ $estudiante->nombres }} {{ $estudiante->apellidos }}
    </h2>

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('boletas.update', [$estudiante, $boleta]) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="ano_escolar_id" class="form-label">Año Escolar</label>
                    <select name="ano_escolar_id" id="ano_escolar_id" class="form-select" required>
                        @foreach($anosEscolares as $anoEscolar)
                            <option value="{{ $anoEscolar->id }}" {{ $boleta->ano_escolar_id == $anoEscolar->id ? 'selected' : '' }}>
                                {{ $anoEscolar->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="momento" class="form-label">Momento</label>
                    <select name="momento" id="momento" class="form-select" required>
                        <option value="1er Momento" {{ $boleta->momento == '1er Momento' ? 'selected' : '' }}>1er Momento</option>
                        <option value="2do Momento" {{ $boleta->momento == '2do Momento' ? 'selected' : '' }}>2do Momento</option>
                        <option value="3er Momento" {{ $boleta->momento == '3er Momento' ? 'selected' : '' }}>3er Momento</option>
                    </select>
                </div>

                <!-- Nuevo campo para tipo de boleta -->
                <div class="mb-3">
                    <label for="tipo_boleta" class="form-label">Tipo de Boleta</label>
                    <select name="tipo_boleta" id="tipo_boleta" class="form-select" required>
                        <option value="descriptiva" {{ $boleta->tipo_boleta == 'descriptiva' ? 'selected' : '' }}>Descriptiva</option>
                        <option value="calificativa" {{ $boleta->tipo_boleta == 'calificativa' ? 'selected' : '' }}>Calificativa</option>
                    </select>
                </div>

                <!-- Sistema de calificación (solo visible para boletas calificativas) -->
                <div id="sistema_calificacion_container" class="mb-3" style="display: none;">
                    <label for="sistema_calificacion" class="form-label">Sistema de Calificación</label>
                    <select name="sistema_calificacion" id="sistema_calificacion" class="form-select">
                        <option value="literal" {{ old('sistema_calificacion', isset($boleta->calificacionesAsignaturas->first()->calificacion_literal) ? 'literal' : '') == 'literal' ? 'selected' : '' }}>Literal (A, B, C, D, E)</option>
                        <option value="numerica" {{ old('sistema_calificacion', isset($boleta->calificacionesAsignaturas->first()->calificacion_numerica) ? 'numerica' : '') == 'numerica' ? 'selected' : '' }}>Numérica (0-20)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="proyecto" class="form-label">Nombre del Proyecto</label>
                    <input type="text" name="proyecto" id="proyecto" class="form-control" value="{{ $boleta->proyecto }}" required>
                </div>

                <div class="mb-3">
                    <label for="observaciones" class="form-label">Observaciones Generales</label>
                    <textarea name="observaciones" id="observaciones" class="form-control" rows="3">{{ $boleta->observaciones }}</textarea>
                </div>

                <!-- Contenedor para calificación general -->
                <div id="calificacion_general_container" class="mb-3" style="{{ $boleta->momento == '3er Momento' ? 'display: block;' : 'display: none;' }}">
                    <label for="calificacion_general" class="form-label">Calificación General</label>
                    
                    <!-- Calificación general literal -->
                    <div id="calificacion_general_literal">
                        <select name="calificacion_general" id="calificacion_general_literal_select" class="form-select">
                            <option value="">Seleccione una calificación</option>
                            <option value="A" {{ $boleta->calificacion_general == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ $boleta->calificacion_general == 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ $boleta->calificacion_general == 'C' ? 'selected' : '' }}>C</option>
                            <option value="D" {{ $boleta->calificacion_general == 'D' ? 'selected' : '' }}>D</option>
                            <option value="E" {{ $boleta->calificacion_general == 'E' ? 'selected' : '' }}>E</option>
                        </select>
                    </div>
                    
                    <!-- Calificación general numérica -->
                    <div id="calificacion_general_numerica" style="display: none;">
                        <input type="number" name="calificacion_general_numerica" id="calificacion_general_numerica_input" class="form-control" min="0" max="20" step="1" value="{{ $boleta->calificacion_general_numerica ?? '' }}">
                    </div>
                </div>

                <h4 class="mt-4">Calificaciones por Asignatura</h4>
                @foreach($asignaturas as $asignatura)
                <div class="mb-3 asignatura-container">
                    <h5>{{ $asignatura->nombre }}</h5>
                    <input type="hidden" name="calificaciones[{{ $asignatura->id }}][asignatura_id]" value="{{ $asignatura->id }}">
                    
                    @php
                        $calificacion = $boleta->calificacionesAsignaturas->where('asignatura_id', $asignatura->id)->first();
                    @endphp
                    
                    <!-- Campos para boleta descriptiva -->
                    <div class="descripcion-field">
                        <label for="calificaciones[{{ $asignatura->id }}][descripcion]" class="form-label">Descripción</label>
                        <textarea name="calificaciones[{{ $asignatura->id }}][descripcion]" class="form-control" rows="3">{{ $calificacion->descripcion ?? '' }}</textarea>
                    </div>
                    
                    <!-- Campos para boleta calificativa - Literal -->
                    <div class="calificacion-literal-field" style="display: none;">
                        <label for="calificaciones[{{ $asignatura->id }}][calificacion_literal]" class="form-label">Calificación Literal</label>
                        <select name="calificaciones[{{ $asignatura->id }}][calificacion_literal]" class="form-select">
                            <option value="">Seleccione una calificación</option>
                            <option value="A" {{ isset($calificacion->calificacion_literal) && $calificacion->calificacion_literal == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ isset($calificacion->calificacion_literal) && $calificacion->calificacion_literal == 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ isset($calificacion->calificacion_literal) && $calificacion->calificacion_literal == 'C' ? 'selected' : '' }}>C</option>
                            <option value="D" {{ isset($calificacion->calificacion_literal) && $calificacion->calificacion_literal == 'D' ? 'selected' : '' }}>D</option>
                            <option value="E" {{ isset($calificacion->calificacion_literal) && $calificacion->calificacion_literal == 'E' ? 'selected' : '' }}>E</option>
                        </select>
                    </div>
                    
                    <!-- Campos para boleta calificativa - Numérica -->
                    <div class="calificacion-numerica-field" style="display: none;">
                        <label for="calificaciones[{{ $asignatura->id }}][calificacion_numerica]" class="form-label">Calificación Numérica (0-20)</label>
                        <input type="number" name="calificaciones[{{ $asignatura->id }}][calificacion_numerica]" class="form-control" min="0" max="20" step="1" value="{{ $calificacion->calificacion_numerica ?? '' }}">
                    </div>
                </div>
                @endforeach

                <div class="d-flex justify-content-between">
                    <a href="{{ route('boletas.index', $estudiante) }}" class="btn btn-outline-danger">
                        <i class="fa-solid fa-arrow-left me-2"></i>Regresar
                    </a>
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-save me-2"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const momentoSelect = document.getElementById('momento');
    const calificacionGeneralContainer = document.getElementById('calificacion_general_container');
    const tipoBoletaSelect = document.getElementById('tipo_boleta');
    const sistemaCalificacionContainer = document.getElementById('sistema_calificacion_container');
    const sistemaCalificacionSelect = document.getElementById('sistema_calificacion');
    const calificacionGeneralLiteral = document.getElementById('calificacion_general_literal');
    const calificacionGeneralNumerica = document.getElementById('calificacion_general_numerica');
    
    // Función para mostrar/ocultar calificación general según el momento
    function toggleCalificacionGeneral() {
        if (momentoSelect.value === '3er Momento') {
            calificacionGeneralContainer.style.display = 'block';
            updateCalificacionGeneralType();
        } else {
            calificacionGeneralContainer.style.display = 'none';
        }
    }
    
    // Función para mostrar/ocultar campos según el tipo de boleta
    function toggleTipoBoleta() {
        const isCalificativa = tipoBoletaSelect.value === 'calificativa';
        
        // Mostrar/ocultar selector de sistema de calificación
        sistemaCalificacionContainer.style.display = isCalificativa ? 'block' : 'none';
        
        // Mostrar/ocultar campos de calificación
        document.querySelectorAll('.descripcion-field').forEach(el => {
            el.style.display = isCalificativa ? 'none' : 'block';
        });
        
        if (isCalificativa) {
            toggleSistemaCalificacion();
        } else {
            document.querySelectorAll('.calificacion-literal-field, .calificacion-numerica-field').forEach(el => {
                el.style.display = 'none';
            });
        }
        
        // Actualizar tipo de calificación general si es 3er momento
        if (momentoSelect.value === '3er Momento') {
            updateCalificacionGeneralType();
        }
    }
    
    // Función para mostrar/ocultar campos según el sistema de calificación
    function toggleSistemaCalificacion() {
        const isLiteral = sistemaCalificacionSelect.value === 'literal';
        
        document.querySelectorAll('.calificacion-literal-field').forEach(el => {
            el.style.display = isLiteral ? 'block' : 'none';
        });
        
        document.querySelectorAll('.calificacion-numerica-field').forEach(el => {
            el.style.display = isLiteral ? 'none' : 'block';
        });
        
        // Actualizar tipo de calificación general si es 3er momento
        if (momentoSelect.value === '3er Momento') {
            updateCalificacionGeneralType();
        }
    }
    
    // Función para actualizar el tipo de calificación general
    function updateCalificacionGeneralType() {
        const isCalificativa = tipoBoletaSelect.value === 'calificativa';
        
        if (isCalificativa) {
            const isLiteral = sistemaCalificacionSelect.value === 'literal';
            calificacionGeneralLiteral.style.display = isLiteral ? 'block' : 'none';
            calificacionGeneralNumerica.style.display = isLiteral ? 'none' : 'block';
        } else {
            // Para boletas descriptivas, siempre usar calificación literal
            calificacionGeneralLiteral.style.display = 'block';
            calificacionGeneralNumerica.style.display = 'none';
        }
    }
    
    // Eventos
    momentoSelect.addEventListener('change', toggleCalificacionGeneral);
    tipoBoletaSelect.addEventListener('change', toggleTipoBoleta);
    sistemaCalificacionSelect.addEventListener('change', toggleSistemaCalificacion);
    
    // Inicializar estados
    toggleCalificacionGeneral();
    toggleTipoBoleta();
});
</script>
@endpush