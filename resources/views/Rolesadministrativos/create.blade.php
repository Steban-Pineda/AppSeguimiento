@extends('adminlte::page')

@section('title', 'Crear reoles administrativos')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Registrar rol administrativo</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('rolesadministrativos.store') }}">
                @csrf

                <div class="form-group">
                    <label>Descripcion</label>
                    <input type="text" name="Descripcion" class="form-control" required>
                </div>



                <button type="submit" class="btn btn-success">
                    Guardar
                </button>

                <a href="{{ route('rolesadministrativos.index') }}" class="btn btn-secondary">
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
