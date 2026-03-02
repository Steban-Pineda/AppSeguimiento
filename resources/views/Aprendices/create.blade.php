@extends('adminlte::page')

{{-- 1. Título dinámico --}}
@section('title', isset($aprendiz) ? 'Editar Aprendiz' : 'Registrar Aprendiz')

@section('content')
    <div class="card {{ isset($aprendiz) ? 'card-warning' : 'card-primary' }}">
        <div class="card-header">
            <h3 class="card-title">
                {{ isset($aprendiz) ? 'Editar Aprendiz: ' . $aprendiz->Nombres : 'Registrar Nuevo Aprendiz' }}
            </h3>
        </div>

        <div class="card-body">
            {{-- 2. Acción dinámica: Update o Store --}}
            <form method="POST"
                  action="{{ isset($aprendiz) ? route('Aprendices.update', $aprendiz->NIS) : route('Aprendices.store') }}">

                @csrf
                {{-- 3. Método PUT solo si existe el aprendiz --}}
                @if(isset($aprendiz))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Tipo de documento</label>
                        <select name="tbl_tiposdocumento_NIS" class="form-control" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($tiposDoc as $td)
                                <option value="{{ $td->NIS }}"
                                    {{ old('tbl_tiposdocumento_NIS', $aprendiz->tbl_tiposdocumento_NIS ?? '') == $td->NIS ? 'selected' : '' }}>
                                    {{ $td->Denominacion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Número documento</label>
                        <input type="number" name="Numdoc" class="form-control"
                               value="{{ old('Numdoc', $aprendiz->Numdoc ?? '') }}" required>
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Sexo</label>
                        <select name="sexo" class="form-control" required>
                            <option value="1" {{ old('sexo', $aprendiz->sexo ?? '') == 1 ? 'selected' : '' }}>Masculino</option>
                            <option value="2" {{ old('sexo', $aprendiz->sexo ?? '') == 2 ? 'selected' : '' }}>Femenino</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Nombres</label>
                        <input type="text" name="Nombres" class="form-control"
                               value="{{ old('Nombres', $aprendiz->Nombres ?? '') }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Apellidos</label>
                        <input type="text" name="Apellidos" class="form-control"
                               value="{{ old('Apellidos', $aprendiz->Apellidos ?? '') }}" required>
                    </div>
                </div>

                {{-- ... (Repetir lógica de isset para el resto de campos: Dirección, Teléfono, etc.) ... --}}

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Tipo EPS</label>
                        <select name="tbl_tiposeps_NIS" class="form-control" required>
                            @foreach($eps as $e)
                                <option value="{{ $e->NIS }}"
                                    {{ old('tbl_tiposeps_NIS', $aprendiz->tbl_tiposeps_NIS ?? '') == $e->NIS ? 'selected' : '' }}>
                                    {{ $e->Denominacion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Ficha</label>
                        <select name="tbl_fichadecaracterizacion_NIS" class="form-control select2-buscable" required>
                            @foreach($fichas as $f)
                                <option value="{{ $f->NIS }}"
                                    {{ old('tbl_fichadecaracterizacion_NIS', $aprendiz->tbl_fichadecaracterizacion_NIS ?? '') == $f->NIS ? 'selected' : '' }}>
                                    {{ $f->Denominacion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn {{ isset($aprendiz) ? 'btn-warning' : 'btn-success' }}">
                    <i class="fas fa-save"></i> {{ isset($aprendiz) ? 'Actualizar' : 'Guardar' }}
                </button>

                <a href="{{ route('Aprendices.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
