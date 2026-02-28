@extends('adminlte::page')

@section('title', isset($alternativaep) ? 'Editar Alternativa' : 'Crear Alternativa')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>
                {{ isset($alternativaep) ? 'Editar Alternativa EP' : 'Crear Alternativa a etapa productiva' }}
            </h3>
        </div>

        <div class="card-body">
            {{-- El action detecta si el objeto existe para ir a update o a store --}}
            <form method="POST"
                  action="{{ (isset($alternativaep) && $alternativaep->exists)
                  ? route('alternativaep.update', $alternativaep->NIS)
                  : route('alternativaep.store') }}">

                @csrf

                {{-- Si estamos editando, agregamos el método PUT --}}
                @if(isset($alternativaep) && $alternativaep->exists)
                    @method('PUT')
                @endif

                {{-- Campo Nombre --}}
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text"
                           name="Nombre"
                           class="form-control @error('Nombre') is-invalid @enderror"
                           value="{{ old('Nombre', $alternativaep->Nombre ?? '') }}"
                           required>
                    @error('Nombre')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Campo Descripcion --}}
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="Descripcion"
                              class="form-control @error('Descripcion') is-invalid @enderror"
                              rows="3"
                              required>{{ old('Descripcion', $alternativaep->Descripcion ?? '') }}</textarea>
                    @error('Descripcion')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> {{ isset($alternativaep) ? 'Actualizar' : 'Guardar' }}
                    </button>

                    <a href="{{ route('alternativaep.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop
