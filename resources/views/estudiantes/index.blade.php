@extends('layouts.app')

@section('title', 'Listado de Estudiantes')

@section('content')
<div class="container">
    <h2><i class="fas fa-user-graduate m-2"></i>Estudiantes</h2>

    <div class="d-flex mb-3">
        <a href="{{ route('estudiantes.create') }}" class="btn btn-outline-dark">
            <i class="fas fa-plus"></i> Crear Nuevo Estudiante
        </a>
    </div>

    <table id="estudiantesTable" class="table table-hover">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cédula</th>
                <th>Escuela</th>
                <th>Grado</th>
                <th>Sección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudiantes as $estudiante)
            <tr>
                <td>{{ $estudiante->nombres }}</td>
                <td>{{ $estudiante->apellidos }}</td>
                <td>{{ $estudiante->cedula }}</td>
                <td>{{ $estudiante->escuela->nombre }}</td>
                <td>{{ $estudiante->grado->nombre }}</td>
                <td>{{ $estudiante->seccion->nombre }}</td>
                <td>
                    <a href="{{ route('boletas.index', $estudiante->id) }}" class="btn btn-sm btn-outline-warning" title="Ver calificaciones">
                        <i class="fas fa-clipboard-list"></i>
                    </a>
                    <a href="{{ route('estudiantes.show', $estudiante->id) }}" class="btn btn-sm btn-outline-dark">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger delete-estudiante">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = $('#estudiantesTable').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        responsive: true
    });

    document.querySelectorAll('.delete-estudiante').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esta acción.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                background: '#333',
                color: '#fff'
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