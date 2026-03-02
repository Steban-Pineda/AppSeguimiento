@extends('adminlte::page')

@section('title', isset($fichadecaracterizacion) ? 'Editar Ficha' : 'Crear Ficha')

{{-- Agregamos CSS de Select2 por si no está cargado globalmente --}}
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ isset($fichadecaracterizacion) ? 'Actualizar Ficha de Caracterización' : 'Registrar Ficha de Caracterización' }}</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ isset($fichadecaracterizacion) ? route('Fichadecaracterizacion.update', $fichadecaracterizacion->NIS) : route('Fichadecaracterizacion.store') }}">
                @csrf
                @if(isset($fichadecaracterizacion)) @method('PUT') @endif

                {{-- ... (campos de código, denominación, cupo y fechas se mantienen igual) ... --}}

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Código</label>
                        <input type="number" name="Codigo" class="form-control" value="{{ old('Codigo', $fichadecaracterizacion->Codigo ?? '') }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Denominación</label>
                        <input type="text" name="Denominacion" class="form-control" value="{{ old('Denominacion', $fichadecaracterizacion->Denominacion ?? '') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Cupo</label>
                        <input type="number" name="Cupo" class="form-control" value="{{ old('Cupo', $fichadecaracterizacion->Cupo ?? '') }}" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Fecha Inicio</label>
                        <input type="date" name="fechaInicio" class="form-control" value="{{ old('fechaInicio', $fichadecaracterizacion->fechaInicio ?? '') }}" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Fecha Fin</label>
                        <input type="date" name="fechaFin" class="form-control" value="{{ old('fechaFin', $fichadecaracterizacion->fechaFin ?? '') }}" required>
                    </div>
                </div>

                {{-- SELECT DE PROGRAMA DE FORMACIÓN CON BUSCADOR --}}
                <div class="form-group">
                    <label>Programa de Formación</label>
                    <select name="tbl_programadeformacion_NIS" class="form-control select-buscador" required style="width: 100%">
                        <option value="">-- Busque y seleccione el Programa --</option>
                        @foreach($programas as $programa)
                            <option value="{{ $programa->NIS }}"
                                {{ (old('tbl_programadeformacion_NIS', $fichadecaracterizacion->tbl_programadeformacion_NIS ?? '') == $programa->NIS) ? 'selected' : '' }}>
                                {{ $programa->Denominacion }} ({{ $programa->Codigo }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- SELECT DE CENTRO DE FORMACIÓN CON BUSCADOR --}}
                <div class="form-group">
                    <label>Centro de Formación</label>
                    <select name="tbl_centrodeformacion_NIS" class="form-control select-buscador" required style="width: 100%">
                        <option value="">-- Busque y seleccione el Centro --</option>
                        @foreach($centros as $centro)
                            <option value="{{ $centro->NIS }}"
                                {{ (old('tbl_centrodeformacion_NIS', $fichadecaracterizacion->tbl_centrodeformacion_NIS ?? '') == $centro->NIS) ? 'selected' : '' }}>
                                {{ $centro->Denominacion }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea name="Observaciones" class="form-control" rows="3" required>{{ old('Observaciones', $fichadecaracterizacion->Observaciones ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                <a href="{{ route('Fichadecaracterizacion.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop

@section('js')
    {{-- JS de Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-buscador').select2({
                theme: 'bootstrap4',
                placeholder: "-- Seleccione una opción --",
                allowClear: true
            });
        });
    </script>
@stop
