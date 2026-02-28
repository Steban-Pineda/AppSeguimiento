@extends('adminlte::page')

@section('title', isset($Regional) ? 'Editar Regional' : 'Crear Regional')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ isset($Regional) ? 'Editar Regional' : 'Crear Nueva Regional' }}</h3>
        </div>

        <div class="card-body">
            <form method="POST"
                  action="{{ (isset($Regional) && $Regional->exists)
                  ? route('Regional.update', $Regional->NIS)
                  : route('Regional.store') }}">

                @csrf

                @if(isset($Regional) && $Regional->exists)
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label>Código</label>
                    <input type="number"
                           name="Codigo"
                           class="form-control @error('Codigo') is-invalid @enderror"
                           value="{{ old('Codigo', $Regional->Codigo ?? '') }}"
                           required>
                    @error('Codigo')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Denominación</label>
                    <input type="text"
                           name="Denominacion"
                           class="form-control @error('Denominacion') is-invalid @enderror"
                           value="{{ old('Denominacion', $Regional->Denominacion ?? '') }}"
                           required>
                    @error('Denominacion')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea name="Observaciones"
                              class="form-control @error('Observaciones') is-invalid @enderror"
                              rows="3"
                              required>{{ old('Observaciones', $Regional->Observaciones ?? '') }}</textarea>
                    @error('Observaciones')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> {{ isset($Regional) ? 'Actualizar' : 'Guardar' }}
                </button>

                <a href="{{ route('Regional.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </form>
        </div>
    </div>
@stop
