@extends('adminlte::page')

@section('title', 'alternativaep')

@section('content')

    <h2>Lista alternativa de etapa productiva</h2>
    <a href="{{ route('alternativaep.create') }}" class="btn btn-primary mb-3">
        Agregar Nuevo Registro
    </a>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>NIS</th>
        <th>Nombre</th>
        <th>Descripcion</th>
    </tr>
    </thead>
    <tbody>
    @foreach($alternativaep as $alternativaep)
        <tr>
            <td>{{ $alternativaep->NIS }}</td>
            <td>{{ $alternativaep->Nombre }}</td>
            <td>{{ $alternativaep->Descripcion }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
