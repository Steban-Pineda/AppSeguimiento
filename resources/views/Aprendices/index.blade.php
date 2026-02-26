@extends('adminlte::page')

@section('title', 'Regional')

@section('content')

<h1>Lista de aprendices</h1>
<a href="{{ route('Aprendices.create') }}" class="btn btn-primary mb-3">
    Agregar Nuevo Registro
</a>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>NIS</th>
        <th>Numdoc</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>CorreoInstitucional</th>
        <th>CorreoPersonal</th>
        <th>sexo</th>
        <th>fechaNacimiento</th>
        <th>tbl_tiposdocumento_NIS</th>
        <th>tbl_tiposeps_NIS</th>
        <th>tbl_fichadecaracterizacion_NIS</th>
    </tr>
    </thead>
    <tbody>
    @foreach($Aprendices as $Aprendices)
        <tr>
            <td>{{ $Aprendices->NIS }}</td>
            <td>{{ $Aprendices->Numdoc }}</td>
            <td>{{ $Aprendices->Nombres }}</td>
            <td>{{ $Aprendices->Apellidos }}</td>
            <td>{{ $Aprendices->Direccion }}</td>
            <td>{{ $Aprendices->Telefono }}</td>
            <td>{{ $Aprendices->CorreoInstitucional }}</td>
            <td>{{ $Aprendices->CorreoPersonal }}</td>
            <td>{{ $Aprendices->sexo }}</td>
            <td>{{ $Aprendices->fechaNacimiento }}</td>
            <td>{{ $Aprendices->tbl_tiposdocumento_NIS }}</td>
            <td>{{ $Aprendices->tbl_tiposeps_NIS }}</td>
            <td>{{ $Aprendices->tbl_fichadecaracterizacion_NIS }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
