@extends('adminlte::page')

@section('title', 'Crear Regional')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Crear sub alternativa</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('Subalternativaep.store') }}">
                @csrf

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="Nombre" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Descripcion</label>
                    <input type="text" name="Descripcion" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">
                    Guardar
                </button>

                <a href="{{ route('Subalternativaep.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </form>
        </div>
    </div>
@stop
