@extends('adminlte::page')

@section('title', 'Crear Regional')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Crear Regional</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('Regional.store') }}">
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
                    <label>Observaciones</label>
                    <input type="text" name="Observaciones" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">
                    Guardar
                </button>

                <a href="{{ route('Regional.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </form>
        </div>
    </div>
@stop
