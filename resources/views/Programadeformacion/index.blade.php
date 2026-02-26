

@extends('adminlte::page')

@section('title', 'Crear programa de formacion')

@section('content')
<h1>Lista programas de formacion</h1>
<a href="{{ route('programadeformacion.create') }}" class="btn btn-primary mb-3">
    Agregar Nuevo instructor
</a>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>NIS</th>
        <th>Codigo</th>
        <th>Denominacion</th>
        <th>Observaciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($Programa as $Programa)
        <tr>
            <td>{{ $Programa->NIS }}</td>
            <td>{{ $Programa->Codigo }}</td>
            <td>{{ $Programa->Denominacion }}</td>
            <td>{{ $Programa->Observaciones }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
