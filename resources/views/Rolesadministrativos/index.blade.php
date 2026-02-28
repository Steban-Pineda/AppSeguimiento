@extends('adminlte::page')

@section('title', 'Roles Administrativos')

@section('content_header')
    <h1>Lista de Roles Administrativos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('rolesadministrativos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Agregar Nuevo Rol
            </a>

            <div class="card-tools">
                <form action="{{ route('rolesadministrativos.index') }}" method="GET" class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="buscar" class="form-control"
                           placeholder="Buscar por Descripción o NIS..."
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
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fas fa-check"></i> {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 80px;">NIS</th>
                    <th>Descripción</th>
                    <th style="width: 150px;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($RolesAdministrativos as $item)
                    <tr>
                        <td>{{ $item->NIS }}</td>
                        <td>{{ $item->Descripcion }}</td>
                        <td>
                            <div class="btn-group">
                                {{-- BOTÓN SHOW AÑADIDO AQUÍ --}}
                                <a href="{{ route('rolesadministrativos.show', $item->NIS) }}"
                                   class="btn btn-info btn-sm mr-1" title="Ver Detalle">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('rolesadministrativos.edit', $item->NIS) }}"
                                   class="btn btn-warning btn-sm mr-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('rolesadministrativos.destroy', $item->NIS) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Está seguro de eliminar el rol: {{ $item->Descripcion }}?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No se encontraron roles administrativos.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            <div class="float-right">
                {{ $RolesAdministrativos->links() }}
            </div>
            <p class="text-muted m-0">
                Mostrando {{ $RolesAdministrativos->count() }} de {{ $RolesAdministrativos->total() }} registros
            </p>
        </div>
    </div>
@stop
