@extends('layouts.app')

@section('title', 'Administración Académica')

@section('content')
<div class="container">
    <h2><i class="fas fa-cogs m-2"></i>Administración Académica</h2>

    <div class="row">
        <!-- Grados -->
        <div class="col-md-4 mb-2">
            <div class="card">
                <div class="card-header">
                    <h3>Grados</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('grados.crear') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="grado_nombre" class="form-label">Nuevo Grado</label>
                            <input type="text" class="form-control" id="grado_nombre" name="nombre" required>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Agregar Grado</button>
                    </form>
                    <hr>
                    <ul class="list-group mt-3">
                        @foreach($grados as $grado)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $grado->nombre }}
                                <div>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editarGradoModal{{ $grado->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('grados.eliminar', $grado->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger delete-btn" data-type="grado" data-id="{{ $grado->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                            
                            <!-- Modal para editar grado -->
                            <div class="modal fade" id="editarGradoModal{{ $grado->id }}" tabindex="-1" aria-labelledby="editarGradoModalLabel{{ $grado->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editarGradoModalLabel{{ $grado->id }}">Editar Grado</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('grados.actualizar', $grado->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="grado_nombre_{{ $grado->id }}" class="form-label">Nombre del Grado</label>
                                                    <input type="text" class="form-control" id="grado_nombre_{{ $grado->id }}" name="nombre" value="{{ $grado->nombre }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-delete-left me-2"></i>Cerrar</button>
                                                <button type="submit" class="btn btn-outline-primary"><i class="fas fa-solid fa-floppy-disk me-2"></i>Guardar cambios</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Secciones -->
        <div class="col-md-4 mb-2">
            <div class="card">
                <div class="card-header">
                    <h3>Secciones</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('secciones.crear') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="seccion_nombre" class="form-label">Nueva Sección</label>
                            <input type="text" class="form-control" id="seccion_nombre" name="nombre" required>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Agregar Sección</button>
                    </form>
                    <hr>
                    <ul class="list-group mt-3">
                        @foreach($secciones as $seccion)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $seccion->nombre }}
                                <div>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editarSeccionModal{{ $seccion->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('secciones.eliminar', $seccion->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger delete-btn" data-type="sección" data-id="{{ $seccion->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                            
                            <!-- Modal para editar sección -->
                            <div class="modal fade" id="editarSeccionModal{{ $seccion->id }}" tabindex="-1" aria-labelledby="editarSeccionModalLabel{{ $seccion->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editarSeccionModalLabel{{ $seccion->id }}">Editar Sección</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('secciones.actualizar', $seccion->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="seccion_nombre_{{ $seccion->id }}" class="form-label">Nombre de la Sección</label>
                                                    <input type="text" class="form-control" id="seccion_nombre_{{ $seccion->id }}" name="nombre" value="{{ $seccion->nombre }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-delete-left me-2"></i>Cerrar</button>
                                                <button type="submit" class="btn btn-outline-primary"><i class="fas fa-solid fa-floppy-disk me-2"></i>Guardar cambios</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Asignaturas -->
        <div class="col-md-4 mb-2">
            <div class="card">
                <div class="card-header">
                    <h3>Asignaturas</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('asignaturas.crear') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="asignatura_nombre" class="form-label">Nueva Asignatura</label>
                            <input type="text" class="form-control" id="asignatura_nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="asignatura_descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="asignatura_descripcion" name="descripcion" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Agregar Asignatura</button>
                    </form>
                    <hr>
                    <ul class="list-group mt-3">
                        @foreach($asignaturas as $asignatura)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $asignatura->nombre }}
                                <div>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editarAsignaturaModal{{ $asignatura->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('asignaturas.eliminar', $asignatura->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger delete-btn" data-type="asignatura" data-id="{{ $asignatura->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                            
                            <!-- Modal para editar asignatura -->
                            <div class="modal fade" id="editarAsignaturaModal{{ $asignatura->id }}" tabindex="-1" aria-labelledby="editarAsignaturaModalLabel{{ $asignatura->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editarAsignaturaModalLabel{{ $asignatura->id }}">Editar Asignatura</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('asignaturas.actualizar', $asignatura->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="asignatura_nombre_{{ $asignatura->id }}" class="form-label">Nombre de la Asignatura</label>
                                                    <input type="text" class="form-control" id="asignatura_nombre_{{ $asignatura->id }}" name="nombre" value="{{ $asignatura->nombre }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="asignatura_descripcion_{{ $asignatura->id }}" class="form-label">Descripción</label>
                                                    <textarea class="form-control" id="asignatura_descripcion_{{ $asignatura->id }}" name="descripcion" rows="3">{{ $asignatura->descripcion }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-delete-left me-2"></i>Cerrar</button>
                                                <button type="submit" class="btn btn-outline-primary"><i class="fas fa-solid fa-floppy-disk me-2"></i>Guardar cambios</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Años Escolares -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Años Escolares</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('anos_escolares.crear') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="ano_escolar_nombre" class="form-label">Nuevo Año Escolar</label>
                            <input type="text" class="form-control" id="ano_escolar_nombre" name="nombre" required placeholder="Ej: 2023-2024">
                        </div>
                        <div class="mb-3">
                            <label for="ano_escolar_inicio" class="form-label">Fecha Inicio</label>
                            <input type="text" class="form-control" id="ano_escolar_inicio" name="fecha_inicio" placeholder="Ej: Enero 2024">
                        </div>
                        <div class="mb-3">
                            <label for="ano_escolar_fin" class="form-label">Fecha Fin</label>
                            <input type="text" class="form-control" id="ano_escolar_fin" name="fecha_fin" placeholder="Ej: Diciembre 2024">
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Agregar Año Escolar</button>
                    </form>
                    <hr>
                    <ul class="list-group mt-3">
                        @foreach($anos_escolares as $ano_escolar)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $ano_escolar->nombre }}
                                <div>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editarAnoEscolarModal{{ $ano_escolar->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('anos_escolares.eliminar', $ano_escolar->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger delete-btn" data-type="año escolar" data-id="{{ $ano_escolar->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                            
                            <!-- Modal para editar año escolar -->
                            <div class="modal fade" id="editarAnoEscolarModal{{ $ano_escolar->id }}" tabindex="-1" aria-labelledby="editarAnoEscolarModalLabel{{ $ano_escolar->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editarAnoEscolarModalLabel{{ $ano_escolar->id }}">Editar Año Escolar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('anos_escolares.actualizar', $ano_escolar->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="ano_escolar_nombre_{{ $ano_escolar->id }}" class="form-label">Año Escolar</label>
                                                    <input type="text" class="form-control" id="ano_escolar_nombre_{{ $ano_escolar->id }}" name="nombre" value="{{ $ano_escolar->nombre }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fecha_inicio_{{ $ano_escolar->id }}" class="form-label">Fecha Inicio</label>
                                                    <input type="text" class="form-control" id="fecha_inicio_{{ $ano_escolar->id }}" name="fecha_inicio" value="{{ $ano_escolar->fecha_inicio }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fecha_fin_{{ $ano_escolar->id }}" class="form-label">Fecha Fin</label>
                                                    <input type="text" class="form-control" id="fecha_fin_{{ $ano_escolar->id }}" name="fecha_fin" value="{{ $ano_escolar->fecha_fin }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-delete-left me-2"></i>Cerrar</button>
                                                <button type="submit" class="btn btn-outline-primary"><i class="fas fa-solid fa-floppy-disk me-2"></i>Guardar cambios</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    //SweetAlert2
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const itemType = this.dataset.type;
            const itemId = this.dataset.id;
            const form = this.closest('form');

            Swal.fire({
                title: '¿Estás seguro?',
                text: `¿Deseas eliminar este ${itemType}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush