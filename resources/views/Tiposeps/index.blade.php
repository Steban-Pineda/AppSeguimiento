@extends('adminlte::page')

@section('title', 'Tipos de EPS')

@section('content_header')
    <h1>Lista de Tipos de EPS</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('tiposeps.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Agregar Nueva EPS
            </a>

            <div class="card-tools">
                {{-- Buscador integrado --}}
                <form action="{{ route('tiposeps.index') }}" method="GET" class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar..." value="{{ request('buscar') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>NIS</th>
                    <th>Núm. Doc</th>
                    <th>Denominación</th>
                    <th>Observaciones</th>
                    <th style="width: 150px;">Acciones</th>
                </tr>
                </thead>
                <tbody>

                @forelse($tiposeps as $item)
                    <tr>
                        <td>{{ $item->NIS }}</td>
                        <td>{{ $item->numdoc }}</td>
                        <td>{{ $item->Denominacion }}</td>
                        <td>{{ Str::limit($item->Observaciones, 40) }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('tiposeps.show', $item->NIS) }}" class="btn btn-info btn-sm mr-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('tiposeps.edit', $item->NIS) }}" class="btn btn-warning btn-sm mr-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tiposeps.destroy', $item->NIS) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta EPS?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay registros disponibles.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- PIE DE PÁGINA CON PAGINACIÓN --}}
        <div class="card-footer clearfix">
            <div class="float-right">
                {{ $tiposeps->links() }}
            </div>
            <p class="text-muted m-0">
                Mostrando {{ $tiposeps->firstItem() }} a {{ $tiposeps->lastItem() }} de {{ $tiposeps->total() }} registros
            </p>
        </div>
    </div>
@stop
