@extends('adminlte::page')

@section('title', 'Crear instructor')

@section('content')

<h1>Lista instructor</h1>

<a href="{{ route('Instructor.create') }}" class="btn btn-primary mb-3">
    Agregar Nuevo instructor
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
        <th>tbl_rolesadministrativos_NIS1</th>
        <th>tbl_tiposeps_NIS</th>
        <th>tbl_tiposdocumento_NIS</th>
    </tr>
    </thead>
    <tbody>
    @foreach($Instructor as $Instructor)
        <tr>
            <td>{{ $Instructor->NIS }}</td>
            <td>{{ $Instructor->Numdoc }}</td>
            <td>{{ $Instructor->Nombres }}</td>
            <td>{{ $Instructor->Apellidos }}</td>
            <td>{{ $Instructor->Direccion }}</td>
            <td>{{ $Instructor->Telefono }}</td>
            <td>{{ $Instructor->CorreoInstitucional }}</td>
            <td>{{ $Instructor->CorreoPersonal }}</td>
            <td>{{ $Instructor->sexo }}</td>
            <td>{{ $Instructor->fechaNacimiento }}</td>
            <td>{{ $Instructor->tbl_rolesadministrativos_NIS1 }}</td>
            <td>{{ $Instructor->tbl_tiposeps_NIS }}</td>
            <td>{{ $Instructor->tbl_tiposdocumento_NIS }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
