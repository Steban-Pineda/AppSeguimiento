@extends('adminlte::page')

@section('title', 'Tipos de Documento')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Lista de Tipos de Documento</h1>

            <div class="card-tools">
                <form action="{{ route('tiposdocumento.index') }}" method="GET" class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="buscar" class="form-control float-right"
                           placeholder="Buscar por Denominación o NIS..."
                           value="{{ request('buscar') }}">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('buscar'))
                            <a href="{{ route('tiposdocumento.index') }}" class="btn btn-default" title="Limpiar búsqueda">
                                <i class="fas fa-times text-danger"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <a href="{{ route('tiposdocumento.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Agregar Nueva sub alternativa
            </a>

            @if(session('success'))
                <div class="alert alert-success mt-2">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mt-2">
                    {{ session('error') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>NIS</th>
                    <th>Denominación</th>
                    <th>Observaciones</th>
                    <th style="width: 180px;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tipodoc as $item)
                    <tr>
                        <td>{{ $item->NIS }}</td>
                        <td>{{ $item->Denominacion }}</td>
                        <td>{{ $item->Observaciones }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('tiposdocumento.show', $item->NIS) }}"
                                   class="btn btn-info btn-sm mr-1" title="Ver Detalle">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('tiposdocumento.edit', $item->NIS) }}"
                                   class="btn btn-warning btn-sm mr-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('tiposdocumento.destroy', $item->NIS) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"
                                            onclick="return confirm('¿Está seguro de eliminar el registro {{ $item->NIS }}?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No se encontraron resultados para la búsqueda.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
