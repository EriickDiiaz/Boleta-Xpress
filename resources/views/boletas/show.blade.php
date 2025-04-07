@extends('layouts.app')

@section('title', 'Ver Boleta de ' . $estudiante->nombres . ' ' . $estudiante->apellidos)

@section('content')
<div class="container">
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ Session::get('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2>
        <i class="fas fa-clipboard-list m-2"></i>
        Detalles de Boleta de {{ $estudiante->nombres }} {{ $estudiante->apellidos }}
    </h2>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Año Escolar:</strong> {{ $boleta->anoEscolar->nombre }}</p>
                    <p><strong>Nombre del Proyecto:</strong> {{ $boleta->proyecto }}</p>
                    <p><strong>Momento:</strong> {{ $boleta->momento }}</p>
                    <p><strong>Grado:</strong> {{ $boleta->grado->nombre }}</p>
                    <p><strong>Sección:</strong> {{ $boleta->seccion->nombre }}</p>
                    <p><strong>Tipo de Boleta:</strong> {{ ucfirst($boleta->tipo_boleta) }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Calificación General:</strong> {{ $boleta->calificacion_general ?? 'N/A' }}</p>
                    <p><strong>Observaciones Generales:</strong> {{ $boleta->observaciones ?? 'Sin observaciones' }}</p>
                </div>
            </div>

            <div class="mt-4">
                <h4>Calificaciones por Asignatura</h4>
                
                @if($boleta->tipo_boleta == 'descriptiva')
                    <!-- Mostrar calificaciones descriptivas -->
                    @foreach($boleta->calificacionesAsignaturas as $calificacion)
                    <div class="mb-3">
                        <h5>{{ $calificacion->asignatura->nombre }}</h5>
                        <p>{{ $calificacion->descripcion }}</p>
                    </div>
                    @endforeach
                @else
                    <!-- Mostrar calificaciones literales o numéricas -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Asignatura</th>
                                    @if(isset($boleta->calificacionesAsignaturas->first()->calificacion_literal))
                                        <th>Calificación Literal</th>
                                    @else
                                        <th>Calificación Numérica</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($boleta->calificacionesAsignaturas as $calificacion)
                                <tr>
                                    <td>{{ $calificacion->asignatura->nombre }}</td>
                                    @if(isset($calificacion->calificacion_literal))
                                        <td class="text-center">{{ $calificacion->calificacion_literal }}</td>
                                    @else
                                        <td class="text-center">{{ $calificacion->calificacion_numerica }}</td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('boletas.index', $estudiante) }}" class="btn btn-outline-danger">
                    <i class="fa-solid fa-arrow-left me-2"></i>Regresar
                </a>
                <a href="{{ route('boletas.pdf', [$estudiante, $boleta]) }}" class="btn btn-outline-dark" target="_blank">
                    <i class="fas fa-file-pdf me-2"></i>Generar PDF
                </a>
                <a href="{{ route('boletas.edit', [$estudiante, $boleta]) }}" class="btn btn-outline-primary">
                    <i class="fas fa-edit me-2"></i>Editar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection