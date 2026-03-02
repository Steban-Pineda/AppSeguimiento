@extends('adminlte::page')

@section('title', 'Programas de Formación')

@section('content_header')
    <h1>Lista de Programas de Formación</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('programadeformacion.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Agregar Nuevo Programa
            </a>

            {{-- Buscador --}}
            <div class="card-tools">
                <form action="{{ route('programadeformacion.index') }}" method="GET" class="input-group input-group-sm" style="width: 280px;">
                    <input type="text" name="buscar" class="form-control float-right"
                           placeholder="Buscar programa..."
                           value="{{ request('buscar') }}">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            {{-- Alertas --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>NIS</th>
                    <th>Código</th>
                    <th>Denominación</th>
                    <th>Observaciones</th>
                    <th style="width: 160px;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($Programa as $item)
                    <tr>
                        <td>{{ $item->NIS }}</td>
                        <td>{{ $item->Codigo }}</td>
                        <td>{{ $item->Denominacion }}</td>
                        <td>{{ Str::limit($item->Observaciones, 50) }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('programadeformacion.show', $item->NIS) }}" class="btn btn-info btn-sm mr-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('programadeformacion.edit', $item->NIS) }}" class="btn btn-warning btn-sm mr-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('programadeformacion.destroy', $item->NIS) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar programa?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay programas registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{-- Importante para la paginación --}}
            <div class="float-right">
                {{ $Programa->links() }}
            </div>
        </div>
    </div>
@stop
