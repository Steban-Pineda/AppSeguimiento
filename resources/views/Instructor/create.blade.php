@extends('adminlte::page')

{{-- Título dinámico según la operación --}}
@section('title', isset($instructor) ? 'Editar Instructor' : 'Crear Instructor')

@section('css')
    {{-- CSS necesario para el buscador inteligente --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css">
@stop

@section('content')
    <div class="card {{ isset($instructor) ? 'card-warning' : 'card-primary' }}">
        <div class="card-header">
            <h3>{{ isset($instructor) ? 'Actualizar Instructor' : 'Registrar Instructor' }}</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ isset($instructor) ? route('Instructor.update', $instructor->NIS) : route('Instructor.store') }}">
                @csrf
                @if(isset($instructor)) @method('PUT') @endif

                <div class="row">
                    {{-- Tipo de Documento --}}
                    <div class="col-md-4 form-group">
                        <label>Tipo de Documento</label>
                        <select name="tbl_tiposdocumento_NIS" class="form-control select-buscador" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($tiposDoc as $td)
                                <option value="{{ $td->NIS }}" {{ (old('tbl_tiposdocumento_NIS', $instructor->tbl_tiposdocumento_NIS ?? '') == $td->NIS) ? 'selected' : '' }}>
                                    {{ $td->Denominacion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Número de Documento --}}
                    <div class="col-md-4 form-group">
                        <label>Número Documento</label>
                        <input type="number" name="Numdoc" class="form-control" value="{{ old('Numdoc', $instructor->Numdoc ?? '') }}" required>
                    </div>

                    {{-- Sexo --}}
                    <div class="col-md-4 form-group">
                        <label>Sexo</label>
                        <select name="sexo" class="form-control" required>
                            <option value="">-- Seleccione --</option>
                            <option value="1" {{ (old('sexo', $instructor->sexo ?? '') == 1) ? 'selected' : '' }}>Masculino</option>
                            <option value="2" {{ (old('sexo', $instructor->sexo ?? '') == 2) ? 'selected' : '' }}>Femenino</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Nombres</label>
                        <input type="text" name="Nombres" class="form-control" value="{{ old('Nombres', $instructor->Nombres ?? '') }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Apellidos</label>
                        <input type="text" name="Apellidos" class="form-control" value="{{ old('Apellidos', $instructor->Apellidos ?? '') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Teléfono</label>
                        <input type="text" name="Telefono" class="form-control" value="{{ old('Telefono', $instructor->Telefono ?? '') }}" required>
                    </div>
                    <div class="col-md-8 form-group">
                        <label>Dirección</label>
                        <input type="text" name="Direccion" class="form-control" value="{{ old('Direccion', $instructor->Direccion ?? '') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Correo Institucional</label>
                        <input type="email" name="CorreoInstitucional" class="form-control" value="{{ old('CorreoInstitucional', $instructor->CorreoInstitucional ?? '') }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Correo Personal</label>
                        <input type="email" name="CorreoPersonal" class="form-control" value="{{ old('CorreoPersonal', $instructor->CorreoPersonal ?? '') }}" required>
                    </div>
                </div>

                <div class="row">
                    {{-- Fecha de Nacimiento --}}
                    <div class="col-md-4 form-group">
                        <label>Fecha Nacimiento</label>
                        <input type="date" name="fechaNacimiento" class="form-control" value="{{ old('fechaNacimiento', $instructor->fechaNacimiento ?? '') }}" required>
                    </div>

                    {{-- EPS con Buscador --}}
                    <div class="col-md-4 form-group">
                        <label>EPS</label>
                        <select name="tbl_tiposeps_NIS1" class="form-control select-buscador" required>
                            <option value="">-- Seleccione EPS --</option>
                            @foreach($eps as $e)
                                <option value="{{ $e->NIS }}" {{ (old('tbl_tiposeps_NIS1', $instructor->tbl_tiposeps_NIS1 ?? '') == $e->NIS) ? 'selected' : '' }}>
                                    {{ $e->Denominacion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Rol Administrativo con Buscador --}}
                    <div class="col-md-4 form-group">
                        <label>Rol Administrativo</label>
                        <select name="tbl_rolesadministrativos_NIS1" class="form-control select-buscador" required>
                            <option value="">-- Seleccione Rol --</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->NIS }}" {{ (old('tbl_rolesadministrativos_NIS1', $instructor->tbl_rolesadministrativos_NIS1 ?? '') == $rol->NIS) ? 'selected' : '' }}>
                                    {{ $rol->Descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn {{ isset($instructor) ? 'btn-warning' : 'btn-success' }}">
                        <i class="fas fa-save"></i> {{ isset($instructor) ? 'Actualizar' : 'Guardar' }}
                    </button>
                    <a href="{{ route('Instructor.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>

        {{-- Manejo de Errores de Validación --}}
        @if ($errors->any())
            <div class="card-footer alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@stop

@section('js')
    {{-- JS necesario para activar los buscadores --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-buscador').select2({
                theme: 'bootstrap4',
                width: '100%',
                placeholder: "Seleccione una opción"
            });
        });
    </script>
@stop
