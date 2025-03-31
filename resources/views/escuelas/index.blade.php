@extends('layouts.app')

@section('title','Boletas-Web | Escuelas')
@section('content')

<!-- Mensajes y Notificaciones -->
@if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <i class="fa-solid fa-circle-check"></i>
        {{ Session::get('mensaje') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container">

    <!-- Titulo de la Sección -->
    <div class="d-flex">    
        <h2><i class="fas fa-school m-2"></i>Escuelas</h2>
    </div>
        
    <!-- Botones Agregar -->   
    <div class="d-flex ">
        <a href="{{ route('escuelas.create') }}" class="btn btn-outline-dark mb-3">
            <i class="fas fa-plus"></i> Crear Nueva Escuela
        </a>    
    </div>
    
    <table id="escuelasTable" class="table table-hover">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Nombre</th>
                <th>DEA</th>
                <th>Director</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($escuelas as $escuela)
            <tr>
                <td>
                    <img src="{{ $escuela->logo_url }}" alt="Logo de {{ $escuela->nombre }}" class="img-thumbnail" style="max-width: 50px; max-height: 50px;">
                </td>
                <td>{{ $escuela->nombre }}</td>
                <td>{{ $escuela->dea }}</td>
                <td>{{ $escuela->director }}</td>
                <td>
                    <a href="{{ route('escuelas.show', $escuela->id) }}" class="btn btn-sm btn-outline-dark">
                        <i class="fas fa-eye"></i>
                    </a>
                    
                    <a href="{{ route('escuelas.edit', $escuela->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form action="{{ route('escuelas.destroy', $escuela->id) }}" class="d-inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger delete-escuela">
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

    // Inicializar DataTables
    const table = $('#escuelasTable').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        },
        responsive: true
    });

    // Manejar eliminación de escuela
    document.querySelectorAll('.delete-escuela').forEach(button => {
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