@extends('adminlte::page')

{{-- Título dinámico: Cambia según si la variable $centro existe --}}
@section('title', isset($centro) ? 'Editar Centro' : 'Crear Centro')

{{-- 1. CARGA DE ESTILOS: Aseguramos que el buscador se vea con el estilo de AdminLTE --}}
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css">
@stop

@section('content')
    <div class="card {{ isset($centro) ? 'card-warning' : 'card-primary' }}">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas {{ isset($centro) ? 'fa-edit' : 'fa-plus-circle' }} mr-2"></i>
                {{ isset($centro) ? 'Actualizar Centro de Formación' : 'Registrar Centro de Formación' }}
            </h3>
        </div>

        <div class="card-body">
            {{-- Ruta dinámica: Cambia entre UPDATE (con ID) y STORE --}}
            <form method="POST"
                  action="{{ isset($centro) ? route('Centrodeformacion.update', $centro->NIS) : route('Centrodeformacion.store') }}">

                @csrf
                {{-- Si es edición, agregamos el método PUT que requiere Laravel --}}
                @if(isset($centro))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Código</label>
                        <input type="number" name="Codigo" class="form-control"
                               value="{{ old('Codigo', $centro->Codigo ?? '') }}" required>
                    </div>

                    <div class="col-md-8 form-group">
                        <label>Denominación</label>
                        <input type="text" name="Denominacion" class="form-control"
                               value="{{ old('Denominacion', $centro->Denominacion ?? '') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Dirección</label>
                        <input type="text" name="Direccion" class="form-control"
                               value="{{ old('Direccion', $centro->Direccion ?? '') }}" required>
                    </div>

                    {{-- 2. SELECTOR CON BUSCADOR: Para manejar los 500+ registros de Regionales --}}
                    <div class="col-md-6 form-group">
                        <label>Regional Asociada</label>
                        <select name="tbl_regional_NIS" id="select-regional" class="form-control select-buscador" required style="width: 100%;">
                            <option value="">-- Busque una Regional --</option>
                            @foreach($Regionales as $reg)
                                <option value="{{ $reg->NIS }}"
                                    {{ (old('tbl_regional_NIS', $centro->tbl_regional_NIS ?? '') == $reg->NIS) ? 'selected' : '' }}>
                                    {{ $reg->Codigo }} - {{ $reg->Denominacion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea name="Observaciones" class="form-control" rows="3" required>{{ old('Observaciones', $centro->Observaciones ?? '') }}</textarea>
                </div>

                <hr>
                <div class="form-group text-right">
                    <a href="{{ route('Centrodeformacion.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn {{ isset($centro) ? 'btn-warning' : 'btn-success' }}">
                        <i class="fas fa-save"></i> {{ isset($centro) ? 'Actualizar Registro' : 'Guardar Registro' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    {{-- 3. SCRIPTS DE SELECT2: Cargamos la librería y la inicializamos --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Aplicamos Select2 al ID específico para activar el buscador en tiempo real
            $('#select-regional').select2({
                theme: 'bootstrap4',
                placeholder: "Escriba código o nombre de la regional...",
                allowClear: true,
                language: {
                    noResults: function() { return "No se encontraron resultados"; }
                }
            });
        });
    </script>
@stop
