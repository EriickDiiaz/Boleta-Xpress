@extends('layouts.app')

@section('title', 'Ver Estudiante')

@section('content')
<div class="container">
    <h2><i class="fas fa-user-graduate m-2"></i>Detalles del Estudiante</h2>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nombres:</strong> {{ $estudiante->nombres }}</p>
                    <p><strong>Apellidos:</strong> {{ $estudiante->apellidos }}</p>
                    <p><strong>Género:</strong> {{ $estudiante->genero }}</p>
                    <p><strong>Cédula:</strong> {{ $estudiante->cedula }}</p>
                    <p><strong>Fecha de Nacimiento:</strong> {{ $estudiante->fecha_nacimiento->format('d/m/Y') }}</p>
                    <p><strong>Lugar de Nacimiento:</strong> {{ $estudiante->lugar_nacimiento }}</p>
                    <p><strong>Escuela:</strong> {{ $estudiante->escuela->nombre }}</p>
                    <p><strong>Grado:</strong> {{ $estudiante->grado->nombre }}</p>
                    <p><strong>Sección:</strong> {{ $estudiante->seccion->nombre }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Dirección:</strong> {{ $estudiante->direccion ?? 'No especificada' }}</p>
                    <p><strong>Teléfono:</strong> {{ $estudiante->telefono ?? 'No especificado' }}</p>
                    <p><strong>Correo Electrónico:</strong> {{ $estudiante->correo ?? 'No especificado' }}</p>
                    <p><strong>Nombre del Representante:</strong> {{ $estudiante->nombre_representante ?? 'No especificado' }}</p>
                    <p><strong>Cédula del Representante:</strong> {{ $estudiante->cedula_representante ?? 'No especificado' }}</p>
                    <p><strong>Teléfono del Representante:</strong> {{ $estudiante->telefono_representante ?? 'No especificado' }}</p>
                    <p><strong>Correo del Representante:</strong> {{ $estudiante->correo_representante ?? 'No especificado' }}</p>
                </div>
            </div>
            <div class="mt-4">
                <h4>Asignaturas</h4>
                <ul>
                    @foreach($estudiante->asignaturas as $asignatura)
                        <li>{{ $asignatura->nombre }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('estudiantes.index') }}" class="btn btn-outline-danger">
                    <i class="fa-solid fa-delete-left me-2"></i>Regresar
                </a>
                <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-outline-primary">
                    <i class="fas fa-edit me-2"></i>Editar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection