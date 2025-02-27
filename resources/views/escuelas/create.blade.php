@extends('layouts.app')

@section('title','Agregar Escuela')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-school m-2"></i>Agregar Escuela</h2>
                </div>
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

                    <form action="{{ route('escuelas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="dea" class="form-label">Código DEA</label>
                            <input type="text" class="form-control" id="dea" name="dea" value="{{ old('dea') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="territorial" class="form-label">Territorial N°</label>
                            <input type="text" class="form-control" id="territorial" name="territorial" value="{{ old('territorial') }}">
                        </div>
                        <div class="mb-3">
                            <label for="director" class="form-label">Director(a)</label>
                            <input type="text" class="form-control" id="director" name="director" value="{{ old('director') }}">
                        </div>
                        <div class="mb-3">
                            <label for="subdirector" class="form-label">Sub-Director(a)</label>
                            <input type="text" class="form-control" id="subdirector" name="subdirector" value="{{ old('subdirector') }}">
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}">
                        </div>
                        <div class="mb-3">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ old('ciudad') }}">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}">
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo') }}">
                        </div>
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo">
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <a href="{{ route('escuelas.index') }}" class="btn btn-danger">
                                <i class="fa-solid fa-delete-left me-2"></i>Regresar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Agregar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection