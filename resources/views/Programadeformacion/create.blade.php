@extends('adminlte::page')

@section('title', 'Crear programa de formacion')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Registrar programa de formacion</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('programadeformacion.store') }}">
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
                    <label>Observaciones</label>
                    <input type="text" name="Observaciones" class="form-control" required>
                </div>


                <button type="submit" class="btn btn-success">
                    Guardar
                </button>

                <a href="{{ route('programadeformacion.index') }}" class="btn btn-secondary">
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
