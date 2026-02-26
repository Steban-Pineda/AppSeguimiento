
@extends('adminlte::page')

@section('title', 'Crear Regional')

@section('content')

    <h1>Lista tipo de eps</h1>

<a href="{{ route('tiposeps.create') }}" class="btn btn-primary mb-3">
    Agregar Nueva eps
</a>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>NIS</th>
        <th>numdoc</th>
        <th>Denominacion</th>
        <th>Observaciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tiposeps as $tiposeps)
        <tr>
            <td>{{ $tiposeps->NIS }}</td>
            <td>{{ $tiposeps->numdoc }}</td>
            <td>{{ $tiposeps->Denominacion }}</td>
            <td>{{ $tiposeps->Observaciones }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
