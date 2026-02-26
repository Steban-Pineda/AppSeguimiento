@extends('adminlte::page')

@section('title', isset($tiposdocumento) ? 'Editar Tipo Documento' : 'Crear Tipo Documento')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>
                {{ isset($tiposdocumento) ? 'Editar Tipo de Documento' : 'Crear Tipo de Documento' }}
            </h3>
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ (isset($tiposdocumento) && $tiposdocumento->exists)
          ? route('tiposdocumento.update', ['tiposdocumento' => $tiposdocumento->NIS])
          : route('tiposdocumento.store') }}">

                @csrf

                @isset($tiposdocumento)
                    @method('PUT')
                @endisset

                {{-- Denominacion --}}
                <div class="form-group">
                    <label>Denominación</label>
                    <input type="text"
                           name="Denominacion"
                           class="form-control"
                           value="{{ old('Denominacion', $tiposdocumento->Denominacion ?? '') }}"
                           required>
                </div>

                {{-- Observaciones --}}
                <div class="form-group">
                    <label>Observaciones</label>
                    <input type="text"
                           name="Observaciones"
                           class="form-control"
                           value="{{ old('Observaciones', $tiposdocumento->Observaciones ?? '') }}"
                           required>
                </div>

                <button type="submit" class="btn btn-success">
                    {{ isset($tiposdocumento) ? 'Actualizar' : 'Guardar' }}
                </button>

                <a href="{{ route('tiposdocumento.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>

            </form>
        </div>
    </div>
@stop
