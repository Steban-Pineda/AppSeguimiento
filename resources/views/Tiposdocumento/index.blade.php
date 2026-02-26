
@extends('adminlte::page')

@section('title', 'Crear reoles administrativos')

@section('content')


<h1>Lista de regional</h1>
<a href="{{ route('tiposdocumento.create') }}" class="btn btn-primary mb-3">
    Agregar Nueva sub alternativa
</a>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>NIS</th>
        <th>Denominacion</th>
        <th>Observaciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tipodoc as $tipodoc)
        <tr>
            <td>{{ $tipodoc->NIS }}</td>
            <td>{{ $tipodoc->Denominacion }}</td>
            <td>{{ $tipodoc->Observaciones }}</td>

            <td>
            <a href="{{ route('tiposdocumento.edit', $tipodoc->NIS) }}"
               class="btn btn-warning btn-sm">
                Editar
            </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
