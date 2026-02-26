@extends('adminlte::page')

@section('title', 'Crear Regional')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Crear tipos de documento</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('tiposeps.store') }}">
                @csrf


                <div class="form-group">
                    <label>numero documento</label>
                    <input type="number" name="numdoc" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Denominacion</label>
                    <input type="text" name="Denominacion" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Observaciones</label>
                    <input type="text" name="Observaciones" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">
                    Guardar
                </button>

                <a href="{{ route('tiposeps.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </form>
        </div>
    </div>
@stop
