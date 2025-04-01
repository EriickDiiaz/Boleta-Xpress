@extends('layouts.app')

@section('title', 'Boletas de ' . $estudiante->nombres . ' ' . $estudiante->apellidos)

@section('content')

<div class="container">
    <h2>
        <i class="fas fa-clipboard-list m-2"></i>
        Boletas de {{ $estudiante->nombres }} {{ $estudiante->apellidos }}
    </h2>

    <a href="{{ route('boletas.create', $estudiante) }}" class="btn btn-outline-dark mb-3">
        <i class="fas fa-plus"></i> Crear Nueva Boleta
    </a>

    <div class="card">
        <div class="card-body">
            @if($boletas->isEmpty())
                <p>No hay boletas registradas para este estudiante.</p>
            @else
                <table id="boletasTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Año Escolar</th>
                            <th>Momento</th>
                            <th>Tipo</th>
                            <th>Proyecto</th>
                            <th>Calificación General</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($boletas as $boleta)
                        <tr>
                            <td>{{ $boleta->anoEscolar->nombre }}</td>
                            <td>{{ $boleta->momento }}</td>
                            <td>{{ ucfirst($boleta->tipo_boleta) }}</td>
                            <td>{{ $boleta->proyecto }}</td>
                            <td>{{ $boleta->calificacion_general ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('boletas.show', [$estudiante, $boleta]) }}" class="btn btn-sm btn-outline-dark" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('boletas.edit', [$estudiante, $boleta]) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('boletas.destroy', [$estudiante, $boleta]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger delete-boleta" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = $('#boletasTable').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        responsive: true
    });

    document.querySelectorAll('.delete-boleta').forEach(button => {
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