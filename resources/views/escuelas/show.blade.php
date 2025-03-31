@extends('layouts.app')

@section('title', 'Ver Escuela')
@section('content')
<div class="container">
    <h2><i class="fas fa-school m-2"></i>Detalles de la Escuela</h2>
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ $escuela->logo_url }}" alt="Logo de {{ $escuela->nombre }}" class="img-fluid mb-3">
                </div>
                <div class="col-md-8">
                    <h3>{{ $escuela->nombre }}</h3>
                    <p><strong>DEA:</strong> {{ $escuela->dea }}</p>
                    <p><strong>Territorial N°:</strong> {{ $escuela->territorial }}</p>
                    <p><strong>Director:</strong> {{ $escuela->director }}</p>
                    <p><strong>Subdirector:</strong> {{ $escuela->subdirector }}</p>
                    <p><strong>Dirección:</strong> {{ $escuela->direccion }}</p>
                    <p><strong>Ciudad:</strong> {{ $escuela->ciudad }}</p>
                    <p><strong>Teléfono:</strong> {{ $escuela->telefono }}</p>
                    <p><strong>Correo Electrónico:</strong> {{ $escuela->correo }}</p>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('escuelas.index') }}" class="btn btn-outline-danger">
                    <i class="fa-solid fa-delete-left me-2"></i>Regresar
                </a>
                <a href="{{ route('escuelas.edit', $escuela->id) }}" class="btn btn-outline-primary">
                    <i class="fas fa-edit me-2"></i>Modificar
                </a>
            </div>
        </div>       
    </div>
</div>
@endsection