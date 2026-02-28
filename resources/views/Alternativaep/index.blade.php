@extends('adminlte::page')

@section('title', 'Alternativas EP')

@section('content_header')
    <h1>Lista alternativa de etapa productiva</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('alternativaep.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Agregar Nuevo Registro
            </a>

            <div class="card-tools">
                <form action="{{ route('alternativaep.index') }}" method="GET" class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="buscar" class="form-control float-right"
                           placeholder="Buscar por Nombre o NIS..."
                           value="{{ request('buscar') }}">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('buscar'))
                            <a href="{{ route('alternativaep.index') }}" class="btn btn-default" title="Limpiar">
                                <i class="fas fa-sync text-danger"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            {{-- Mensajes de Éxito o Error --}}
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
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th style="width: 180px;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($alternativaep as $item)
                    <tr>
                        <td>{{ $item->NIS }}</td>
                        <td>{{ $item->Nombre }}</td>
                        <td>{{ $item->Descripcion }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('alternativaep.show', $item->NIS) }}"
                                   class="btn btn-info btn-sm mr-1" title="Ver Detalle">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('alternativaep.edit', $item->NIS) }}"
                                   class="btn btn-warning btn-sm mr-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('alternativaep.destroy', $item->NIS) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"
                                            onclick="return confirm('¿Desea eliminar la alternativa {{ $item->Nombre }}?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No se encontraron registros.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
