
@extends('adminlte::page')

@section('title', 'Crear reoles administrativos')

@section('content')
<h1>Lista de regional</h1>
<a href="{{ route('Subalternativaep.create') }}" class="btn btn-primary mb-3">
    Agregar Nueva sub alternativa
</a>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>NIS</th>
        <th>Nombre</th>
        <th>Descripcion</th>
    </tr>
    </thead>
    <tbody>
    @foreach($Subalternativaep as $Subalternativaep)
        <tr>
            <td>{{ $Subalternativaep->NIS }}</td>
            <td>{{ $Subalternativaep->Nombre }}</td>
            <td>{{ $Subalternativaep->Descripcion }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
