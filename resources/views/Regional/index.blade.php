@extends('adminlte::page')

@section('title', 'Regional')

@section('content')

    <h2>Lista de regional</h2>
    <a href="{{ route('Regional.create') }}" class="btn btn-primary mb-3">
        Agregar Nuevo Registro
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
    @foreach($regional as $regional)
        <tr>
            <td>{{ $regional->NIS }}</td>
            <td>{{ $regional->Codigo }}</td>
            <td>{{ $regional->Denominacion }}</td>
            <td>{{ $regional->Observaciones }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
