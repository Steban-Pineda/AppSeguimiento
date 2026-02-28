@extends('adminlte::page')

{{-- Título dinámico --}}
@section('title', isset($sub) ? 'Editar Subalternativa' : 'Crear Subalternativa')

@section('content')
    <div class="card card-outline {{ isset($sub) ? 'card-warning' : 'card-success' }}">
        <div class="card-header">
            <h3>{{ isset($sub) ? 'Editar Subalternativa EP' : 'Registrar Nueva Subalternativa EP' }}</h3>
        </div>

        <div class="card-body">
            {{-- Acción dinámica: Store o Update --}}
            <form method="POST"
                  action="{{ isset($sub) ? route('Subalternativaep.update', $sub->NIS) : route('Subalternativaep.store') }}">

                @csrf

                {{-- Método PUT obligatorio para actualización --}}
                @if(isset($sub))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="Nombre">Nombre de la Subalternativa</label>
                    <input type="text"
                           name="Nombre"
                           id="Nombre"
                           class="form-control @error('Nombre') is-invalid @enderror"
                           value="{{ old('Nombre', $sub->Nombre ?? '') }}"
                           placeholder="Ej. Contrato de Aprendizaje Externo"
                           required>
                    @error('Nombre')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="Descripcion">Descripción Detallada</label>
                    {{-- Cambiado a textarea para mejor legibilidad de textos largos --}}
                    <textarea name="Descripcion"
                              id="Descripcion"
                              class="form-control @error('Descripcion') is-invalid @enderror"
                              rows="3"
                              placeholder="Describa brevemente la alternativa..."
                              required>{{ old('Descripcion', $sub->Descripcion ?? '') }}</textarea>
                    @error('Descripcion')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn {{ isset($sub) ? 'btn-warning' : 'btn-success' }}">
                        <i class="fas fa-save"></i> {{ isset($sub) ? 'Actualizar' : 'Guardar' }}
                    </button>

                    <a href="{{ route('Subalternativaep.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>

        {{-- Mostrar errores de validación si existen --}}
        @if ($errors->any())
            <div class="card-footer">
                <div class="alert alert-danger mb-0">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
@stop
