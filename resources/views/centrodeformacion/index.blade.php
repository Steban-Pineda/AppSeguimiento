@extends('adminlte::page')

@section('title', 'Crear Centrodeformacion')

@section('content')
<h3>Lista de centros de formacion</h3>
<a href="{{ route('Centrodeformacion.create') }}" class="btn btn-primary mb-3">
    Agregar Nuevo Registro
</a>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>NIS</th>
        <th>Codigo</th>
        <th>Denominacion</th>
        <th>Direccion</th>
        <th>Observaciones</th>
        <th>tbl_regional_NIS</th>
    </tr>
    </thead>
    <tbody>
    @foreach($Centrodeformacion as $Centrodeformacion)
        <tr>
            <td>{{ $Centrodeformacion->NIS }}</td>
            <td>{{ $Centrodeformacion->Codigo }}</td>
            <td>{{ $Centrodeformacion->Denominacion }}</td>
            <td>{{ $Centrodeformacion->Direccion }}</td>
            <td>{{ $Centrodeformacion->Observaciones }}</td>
            <td>{{ $Centrodeformacion->tbl_regional_NIS }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
