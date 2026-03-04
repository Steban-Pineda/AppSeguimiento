@extends('adminlte::page')

@section('title', isset($aprendiz) ? 'Editar Aprendiz' : 'Registrar Aprendiz')

@section('content')
    <div class="card {{ isset($aprendiz) ? 'card-warning' : 'card-primary' }}">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas {{ isset($aprendiz) ? 'fa-edit' : 'fa-user-plus' }} mr-2"></i>
                {{ isset($aprendiz) ? 'Editar Aprendiz: ' . $aprendiz->Nombres : 'Registrar Nuevo Aprendiz' }}
            </h3>
        </div>

        <div class="card-body">
            <form method="POST"
                  action="{{ isset($aprendiz) ? route('Aprendices.update', $aprendiz->NIS) : route('Aprendices.store') }}">

                @csrf
                @if(isset($aprendiz))
                    @method('PUT')
                @endif

                {{-- Fila 1: Documento y Sexo --}}
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
                            <option value="">-- Seleccione --</option>
                            <option value="1" {{ old('sexo', $aprendiz->sexo ?? '') == 1 ? 'selected' : '' }}>Masculino</option>
                            <option value="2" {{ old('sexo', $aprendiz->sexo ?? '') == 2 ? 'selected' : '' }}>Femenino</option>
                        </select>
                    </div>
                </div>

                {{-- Fila 2: Nombres y Apellidos --}}
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

                {{-- Fila 3: Dirección, Teléfono y Fecha Nacimiento --}}
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Dirección</label>
                        <input type="text" name="Direccion" class="form-control"
                               value="{{ old('Direccion', $aprendiz->Direccion ?? '') }}" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Teléfono</label>
                        <input type="text" name="Telefono" class="form-control"
                               value="{{ old('Telefono', $aprendiz->Telefono ?? '') }}" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Fecha de Nacimiento</label>
                        <input type="date" name="fechaNacimiento" class="form-control"
                               value="{{ old('fechaNacimiento', $aprendiz->fechaNacimiento ?? '') }}" required>
                    </div>
                </div>

                {{-- Fila 4: Correos --}}
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Correo Institucional</label>
                        <input type="email" name="CorreoInstitucional" class="form-control"
                               value="{{ old('CorreoInstitucional', $aprendiz->CorreoInstitucional ?? '') }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Correo Personal</label>
                        <input type="email" name="CorreoPersonal" class="form-control"
                               value="{{ old('CorreoPersonal', $aprendiz->CorreoPersonal ?? '') }}" required>
                    </div>
                </div>

                {{-- Fila 5: EPS y Ficha --}}
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Tipo EPS</label>
                        <select name="tbl_tiposeps_NIS" class="form-control" required>
                            <option value="">-- Seleccione EPS --</option>
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
                            <option value="">-- Seleccione Ficha --</option>
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
                <div class="form-group text-right">
                    <a href="{{ route('Aprendices.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn {{ isset($aprendiz) ? 'btn-warning' : 'btn-success' }}">
                        <i class="fas fa-save"></i> {{ isset($aprendiz) ? 'Actualizar Información' : 'Guardar Aprendiz' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2-buscable').select2({
                theme: 'bootstrap4',
                placeholder: "-- Seleccione --",
                allowClear: true
            });
        });
    </script>
@stop
