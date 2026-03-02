@extends('adminlte::page')

@section('title', 'Lista de Fichas')

@section('content_header')
    <h1>Lista de Fichas de Caracterización</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('Fichadecaracterizacion.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Agregar Nueva Ficha
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>NIS</th>
                    <th>Código</th>
                    <th>Denominación</th>
                    <th>Cupo</th>
                    <th>Fechas (Inicio/Fin)</th>
                    <th>Programa de Formación</th>
                    <th>Centro de Formación</th>
                    <th style="width: 150px;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fichadecaracterizacion as $item)
                    <tr>
                        <td>{{ $item->NIS }}</td>
                        <td>{{ $item->Codigo }}</td>
                        <td>{{ $item->Denominacion }}</td>
                        <td>{{ $item->Cupo }}</td>
                        <td>
                            <small>
                                <strong>Ini:</strong> {{ $item->fechaInicio }}<br>
                                <strong>Fin:</strong> {{ $item->fechaFin }}
                            </small>
                        </td>

                        {{-- Uso de Eager Loading para evitar consultas N+1 --}}
                        <td>{{ $item->programa->Denominacion ?? 'Sin Programa' }}</td>
                        <td>{{ $item->centro->Denominacion ?? 'Sin Centro' }}</td>

                        <td>
                            <div class="btn-group">
                                {{-- BOTÓN SHOW: Forzamos el nombre del parámetro de la ruta --}}
                                <a href="{{ route('Fichadecaracterizacion.show', ['Fichadecaracterizacion' => $item->NIS]) }}"
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- BOTÓN EDIT --}}
                                <a href="{{ route('Fichadecaracterizacion.edit', ['Fichadecaracterizacion' => $item->NIS]) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- BOTÓN DELETE --}}
                                <form action="{{ route('Fichadecaracterizacion.destroy', ['Fichadecaracterizacion' => $item->NIS]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta ficha?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
