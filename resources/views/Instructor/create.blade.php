@extends('adminlte::page')

@section('title', 'Crear Instructor')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Registrar Instructor</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('Instructor.store') }}">
                @csrf

                <div class="form-group">
                    <label>Numero dococumento</label>
                    <input type="number" name="Numdoc" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Nombres</label>
                    <input type="text" name="Nombres" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" name="Apellidos" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Direccion</label>
                    <input type="text" name="Direccion" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Telefono</label>
                    <input type="text" name="Telefono" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Correo Institucional</label>
                    <input type="text" name="CorreoInstitucional" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Correo Personal</label>
                    <input type="text" name="CorreoPersonal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>sexo</label>
                    <input type="number" name="sexo" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>fecha Nacimiento</label>
                    <input type="date" name="fechaNacimiento" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>roles administrativos(NIS1)</label>
                    <input type="number" name="tbl_rolesadministrativos_NIS1" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>tipos eps (NIS1)</label>
                    <input type="number" name="tbl_tiposeps_NIS1" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>tipos documento (NIS)</label>
                    <input type="number" name="tbl_tiposdocumento_NIS" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">
                    Guardar
                </button>

                <a href="{{ route('Instructor.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </form>
        </div>
        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>
@stop
