@extends('adminlte::page')

@section('title', isset($rol) ? 'Editar Rol Administrativo' : 'Crear Rol Administrativo')

@section('content')
    <div class="card shadow">
        <div class="card-header bg-navy">
            <h3 class="card-title">
                {{ isset($rol) ? 'Modificar Registro' : 'Registrar Rol Administrativo' }}
            </h3>
        </div>

        <div class="card-body">
            {{-- La ruta cambia automáticamente si existe la variable $rol --}}
            <form method="POST"
                  action="{{ isset($rol) ? route('rolesadministrativos.update', $rol->NIS) : route('rolesadministrativos.store') }}">

                @csrf

                {{-- Si estamos editando, inyectamos el método PUT --}}
                @if(isset($rol))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="Descripcion">Descripción</label>
                    <input type="text"
                           name="Descripcion"
                           id="Descripcion"
                           class="form-control @error('Descripcion') is-invalid @enderror"
                           value="{{ old('Descripcion', $rol->Descripcion ?? '') }}"
                           placeholder="Ej. Coordinador Académico"
                           required>

                    @error('Descripcion')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> {{ isset($rol) ? 'Actualizar Cambios' : 'Guardar Registro' }}
                    </button>

                    <a href="{{ route('rolesadministrativos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>

        {{-- Alerta de errores de validación (estilizada para AdminLTE) --}}
        @if ($errors->any())
            <div class="card-footer">
                <div class="alert alert-danger alert-dismissible mb-0">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Por favor corrige lo siguiente:</h5>
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
