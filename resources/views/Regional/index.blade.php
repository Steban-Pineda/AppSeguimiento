@extends('adminlte::page')

@section('title', 'Regionales')

@section('content_header')
    <h1>Lista de Regionales</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('Regional.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Agregar Nuevo Registro
            </a>

            <div class="card-tools">
                <form action="{{ route('Regional.index') }}" method="GET" class="input-group input-group-sm" style="width: 280px;">
                    <input type="text" name="buscar" class="form-control float-right"
                           placeholder="Buscar por Código, Nombre o NIS..."
                           value="{{ request('buscar') }}">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('buscar'))
                            <a href="{{ route('Regional.index') }}" class="btn btn-default" title="Limpiar búsqueda">
                                <i class="fas fa-sync-alt text-danger"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            {{-- Alertas de sistema --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fas fa-check"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fas fa-ban"></i> {{ session('error') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>NIS</th>
                    <th>Código</th>
                    <th>Denominación</th>
                    <th>Observaciones</th>
                    <th style="width: 150px;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($Regional as $item)
                    <tr>
                        <td>{{ $item->NIS }}</td>
                        <td>{{ $item->Codigo }}</td>
                        <td>{{ $item->Denominacion }}</td>
                        <td>{{ Str::limit($item->Observaciones, 50) }}</td> {{-- Limita el texto largo --}}
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('Regional.show', $item->NIS) }}"
                                   class="btn btn-info btn-sm mr-1" title="Ver Detalle">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('Regional.edit', $item->NIS) }}"
                                   class="btn btn-warning btn-sm mr-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('Regional.destroy', $item->NIS) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Está seguro de eliminar la regional {{ $item->Denominacion }}?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No se encontraron resultados para la búsqueda.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $Regional->links() }}
                </div>
                <p class="text-muted m-0">
                    Mostrando registros del {{ $Regional->firstItem() }} al {{ $Regional->lastItem() }}
                    (Total: {{ $Regional->total() }})
                </p>
            </div>
        </div>
    </div>
@stop
