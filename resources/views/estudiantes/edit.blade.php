@extends('layouts.app')

@section('title', 'Editar Estudiante')

@section('content')
<div class="container">
    <h2><i class="fas fa-user-graduate m-2"></i>Editar Estudiante</h2>

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

            <form action="{{ route('estudiantes.update', $estudiante->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="escuela_id" class="form-label">Escuela</label>
                    <select class="form-select" id="escuela_id" name="escuela_id" required>
                        <option value="">Seleccione una escuela</option>
                        @foreach($escuelas as $escuela)
                            <option value="{{ $escuela->id }}" {{ old('escuela_id', $estudiante->escuela_id) == $escuela->id ? 'selected' : '' }}>
                                {{ $escuela->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="grado_id" class="form-label">Grado</label>
                    <select class="form-select" id="grado_id" name="grado_id" required>
                        <option value="">Seleccione un grado</option>
                        @foreach($grados as $grado)
                            <option value="{{ $grado->id }}" {{ old('grado_id', $estudiante->grado_id) == $grado->id ? 'selected' : '' }}>
                                {{ $grado->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="seccion_id" class="form-label">Sección</label>
                    <select class="form-select" id="seccion_id" name="seccion_id" required>
                        <option value="">Seleccione una sección</option>
                        @foreach($secciones as $seccion)
                            <option value="{{ $seccion->id }}" {{ old('seccion_id', $estudiante->seccion_id) == $seccion->id ? 'selected' : '' }}>
                                {{ $seccion->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" value="{{ old('nombres', $estudiante->nombres) }}" required>
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos', $estudiante->apellidos) }}" required>
                </div>
                <div class="mb-3">
                    <label for="genero" class="form-label">Género</label>
                    <select class="form-select" id="genero" name="genero">
                        <option value="">Seleccione un género</option>
                        <option value="Masculino" {{ old('genero', $estudiante->genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ old('genero', $estudiante->genero) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="cedula" class="form-label">Cédula</label>
                    <input type="text" class="form-control" id="cedula" name="cedula" value="{{ old('cedula', $estudiante->cedula) }}" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $estudiante->fecha_nacimiento ? $estudiante->fecha_nacimiento->format('Y-m-d') : '') }}" required>
                </div>
                <div class="mb-3">
                    <label for="lugar_nacimiento" class="form-label">Lugar de Nacimiento</label>
                    <input type="text" class="form-control" id="lugar_nacimiento" name="lugar_nacimiento" value="{{ old('lugar_nacimiento', $estudiante->lugar_nacimiento) }}">
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $estudiante->direccion) }}">
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $estudiante->telefono) }}">
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo', $estudiante->correo) }}">
                </div>
                <div class="mb-3">
                    <label for="nombre_representante" class="form-label">Nombre del Representante</label>
                    <input type="text" class="form-control" id="nombre_representante" name="nombre_representante" value="{{ old('nombre_representante', $estudiante->nombre_representante) }}">
                </div>
                <div class="mb-3">
                    <label for="cedula_representante" class="form-label">Cédula del Representante</label>
                    <input type="text" class="form-control" id="cedula_representante" name="cedula_representante" value="{{ old('cedula_representante', $estudiante->cedula_representante) }}">
                </div>
                <div class="mb-3">
                    <label for="telefono_representante" class="form-label">Teléfono del Representante</label>
                    <input type="tel" class="form-control" id="telefono_representante" name="telefono_representante" value="{{ old('telefono_representante', $estudiante->telefono_representante) }}">
                </div>
                <div class="mb-3">
                    <label for="correo_representante" class="form-label">Correo del Representante</label>
                    <input type="email" class="form-control" id="correo_representante" name="correo_representante" value="{{ old('correo_representante', $estudiante->correo_representante) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Asignaturas</label>
                    <div class="row">
                        @foreach($asignaturas as $asignatura)
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="asignaturas[]" value="{{ $asignatura->id }}" id="asignatura_{{ $asignatura->id }}" 
                                        {{ (is_array(old('asignaturas', $estudiante->asignaturas->pluck('id')->toArray())) && in_array($asignatura->id, old('asignaturas', $estudiante->asignaturas->pluck('id')->toArray()))) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="asignatura_{{ $asignatura->id }}">
                                        {{ $asignatura->nombre }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('estudiantes.index') }}" class="btn btn-outline-danger">
                        <i class="fa-solid fa-delete-left me-2"></i>Regresar
                    </a>
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-save me-2"></i>Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection