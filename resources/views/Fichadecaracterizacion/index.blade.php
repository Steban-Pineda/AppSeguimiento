@extends('adminlte::page')

@section('title', 'Crear entecoformador')

@section('content')
<h1>Lista de regional</h1>
<a href="{{ route('Fichadecaracterizacion.create') }}" class="btn btn-primary mb-3">
    Agregar nueva ficha de caracterizacion
</a>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>NIS</th>
        <th>Codigo</th>
        <th>Denominacion</th>
        <th>Cupo</th>
        <th>fechaInicio</th>
        <th>fechaFin</th>
        <th>Observaciones</th>
        <th>tbl_programadeformacion_NIS</th>
        <th>tbl_centrodeformacion_NIS</th>
    </tr>
    </thead>
    <tbody>
    @foreach($Fichadecaracterizacion as $Fichadecaracterizacion)
        <tr>
            <td>{{ $Fichadecaracterizacion->NIS }}</td>
            <td>{{ $Fichadecaracterizacion->Codigo }}</td>
            <td>{{ $Fichadecaracterizacion->Denominacion }}</td>
            <td>{{ $Fichadecaracterizacion->Cupo }}</td>
            <td>{{ $Fichadecaracterizacion->fechaInicio }}</td>
            <td>{{ $Fichadecaracterizacion->fechaFin }}</td>
            <td>{{ $Fichadecaracterizacion->Observaciones }}</td>
            <td>{{ $Fichadecaracterizacion->tbl_programadeformacion_NIS }}</td>
            <td>{{ $Fichadecaracterizacion->tbl_centrodeformacion_NIS }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
