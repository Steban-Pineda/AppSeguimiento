@extends('adminlte::page')

@section('title', 'Crear Centrodeformacion')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Registrar centro de formacion</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('Centrodeformacion.store') }}">
                @csrf

                <div class="form-group">
                    <label>Código</label>
                    <input type="number" name="Codigo" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Denominación</label>
                    <input type="text" name="Denominacion" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Direccion</label>
                    <input type="text" name="Direccion" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Observaciones</label>
                    <input type="text" name="Observaciones" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Regional (NIS9</label>
                    <input type="number" name="tbl_regional_NIS" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">
                    Guardar
                </button>

                <a href="{{ route('Centrodeformacion.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </form>
        </div>
    </div>
@stop
