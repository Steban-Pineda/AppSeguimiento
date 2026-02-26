@extends('adminlte::page')

@section('title', 'Crear entecoformador')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Registrar entecoformador</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('enteconformador.store') }}">
                @csrf

                <div class="form-group">
                    <label>Tipo documento</label>
                    <input type="number" name="tdoc" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Numero documento</label>
                    <input type="number" name="Numdoc" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Razon Social</label>
                    <input type="text" name="RazonSocial" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Direccion</label>
                    <input type="text" name="Direccion" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Telefono</label>
                    <input type="number" name="Telefono" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Correo Institucional</label>
                    <input type="text" name="CorreoInstitucional" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">
                    Guardar
                </button>

                <a href="{{ route('enteconformador.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </form>
        </div>
    </div>
@stop
