@extends('adminlte::page')

@section('title', isset($tiposep) ? 'Editar Tipo EPS' : 'Crear Tipo EPS')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ isset($tiposep) ? 'Editar Tipo de EPS' : 'Crear Nuevo Tipo de EPS' }}</h3>
        </div>

        <div class="card-body">
            {{-- La ruta cambia automáticamente según si existe el objeto --}}
            <form method="POST"
                  action="{{ isset($tiposep) ? route('tiposeps.update', $tiposep->NIS) : route('tiposeps.store') }}">

                @csrf

                {{-- Si estamos en modo edición, Laravel necesita el método PUT --}}
                @if(isset($tiposep))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="numdoc">Número Documento</label>
                    <input type="number"
                           name="numdoc"
                           id="numdoc"
                           class="form-control @error('numdoc') is-invalid @enderror"
                           value="{{ old('numdoc', $tiposep->numdoc ?? '') }}"
                           required>
                    @error('numdoc')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Denominacion">Denominación</label>
                    <input type="text"
                           name="Denominacion"
                           id="Denominacion"
                           class="form-control @error('Denominacion') is-invalid @enderror"
                           value="{{ old('Denominacion', $tiposep->Denominacion ?? '') }}"
                           required>
                    @error('Denominacion')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Observaciones">Observaciones</label>
                    <textarea name="Observaciones"
                              id="Observaciones"
                              class="form-control @error('Observaciones') is-invalid @enderror"
                              rows="3"
                              required>{{ old('Observaciones', $tiposep->Observaciones ?? '') }}</textarea>
                    @error('Observaciones')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> {{ isset($tiposep) ? 'Actualizar' : 'Guardar' }}
                    </button>

                    <a href="{{ route('tiposeps.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop
