@extends('adminlte::page')

@section('title', 'Crear Fichadecaracterizacion')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Registrar Ficha de caracterizacion</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('Fichadecaracterizacion.store') }}">
                @csrf

                <div class="form-group">
                    <label>Codigo</label>
                    <input type="number" name="Codigo" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Denominacion</label>
                    <input type="text" name="Denominacion" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Cupo</label>
                    <input type="number" name="Cupo" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>fecha inicio</label>
                    <input type="date" name="fechaInicio" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>fecha fin</label>
                    <input type="date" name="fechaFin" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Observaciones</label>
                    <input type="text" name="Observaciones" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>programa de formacion (NIS)</label>
                    <input type="number" name="tbl_programadeformacion_NIS" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>centro de formacion (NIS)</label>
                    <input type="number" name="tbl_centrodeformacion_NIS" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">
                    Guardar
                </button>

                <a href="{{ route('Fichadecaracterizacion.index') }}" class="btn btn-secondary">
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
