@extends('adminlte::page')

@section('title', 'Crear reoles administrativos')

@section('content')
<h1>Lista roles administrativos</h1>
<a href="{{ route('programadeformacion.create') }}" class="btn btn-primary mb-3">
    Agregar Nuevo instructor
</a>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>NIS</th>
        <th>Descripcion</th>
    </tr>
    </thead>
    <tbody>
    @foreach($RolesAdministrativos as $RolesAdministrativos)
        <tr>
            <td>{{ $RolesAdministrativos->NIS }}</td>
            <td>{{ $RolesAdministrativos->Descripcion }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
