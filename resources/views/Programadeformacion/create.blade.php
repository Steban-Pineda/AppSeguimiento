@extends('adminlte::page')

{{-- Título dinámico según si existe el objeto o no --}}
@section('title', isset($programadeformacion) ? 'Editar Programa' : 'Crear Programa')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ isset($programadeformacion) ? 'Editar Programa de Formación' : 'Registrar Nuevo Programa' }}</h3>
        </div>

        <div class="card-body">
            <form method="POST"
                  action="{{ isset($programadeformacion) ? route('programadeformacion.update', $programadeformacion->NIS) : route('programadeformacion.store') }}">
                @csrf

                @if(isset($programadeformacion))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label>Código</label>
                    <input type="number" name="Codigo"
                           class="form-control @error('Codigo') is-invalid @enderror"
                           value="{{ old('Codigo', $programadeformacion->Codigo ?? '') }}" required>
                    @error('Codigo')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Denominación</label>
                    <input type="text" name="Denominacion"
                           class="form-control @error('Denominacion') is-invalid @enderror"
                           value="{{ old('Denominacion', $programadeformacion->Denominacion ?? '') }}" required>
                    @error('Denominacion')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Observaciones</label>
                    {{-- Cambiado a textarea para mejor UX en textos largos --}}
                    <textarea name="Observaciones"
                              class="form-control @error('Observaciones') is-invalid @enderror"
                              rows="3" required>{{ old('Observaciones', $programadeformacion->Observaciones ?? '') }}</textarea>
                    @error('Observaciones')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> {{ isset($programadeformacion) ? 'Actualizar' : 'Guardar' }}
                </button>

                <a href="{{ route('programadeformacion.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </form>
        </div>
    </div>
@stop
