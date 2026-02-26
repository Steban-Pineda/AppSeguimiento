@extends('adminlte::page')

@section('title', 'Crear entecoformador')

@section('content')
<h1>Lista enteconformador</h1>

<a href="{{ route('enteconformador.create') }}" class="btn btn-primary mb-3">
    Agregar Nuevo enteconformador
</a>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>NIS</th>
        <th>tdoc</th>
        <th>Numdoc</th>
        <th>RazonSocial</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>CorreoInstitucional</th>
    </tr>
    </thead>
    <tbody>
    @foreach($enteconformador as $enteconformador)
        <tr>
            <td>{{ $enteconformador->NIS }}</td>
            <td>{{ $enteconformador->tdoc }}</td>
            <td>{{ $enteconformador->Numdoc }}</td>
            <td>{{ $enteconformador->RazonSocial }}</td>
            <td>{{ $enteconformador->Direccion }}</td>
            <td>{{ $enteconformador->Telefono }}</td>
            <td>{{ $enteconformador->CorreoInstitucional }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
