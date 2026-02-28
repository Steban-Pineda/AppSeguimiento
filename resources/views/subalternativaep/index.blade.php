@extends('adminlte::page')

@section('title', 'Subalternativas EP')

@section('content_header')
    <h1>Lista de Subalternativas de Etapa Productiva</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('Subalternativaep.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Agregar Nueva Subalternativa
            </a>

            <div class="card-tools">
                {{-- Buscador funcional con el controlador --}}
                <form action="{{ route('Subalternativaep.index') }}" method="GET" class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="buscar" class="form-control"
                           placeholder="Buscar por nombre..."
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
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th style="width: 160px;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                {{-- Corregido: Usamos $item para no sobrescribir la colección --}}
                @forelse($Subalternativaep as $item)
                    <tr>
                        <td>{{ $item->NIS }}</td>
                        <td>{{ $item->Nombre }}</td>
                        <td>{{ Str::limit($item->Descripcion, 50) }}</td>
                        <td>
                            <div class="btn-group">
                                {{-- Botón Ver --}}
                                <a href="{{ route('Subalternativaep.show', $item->NIS) }}"
                                   class="btn btn-info btn-sm mr-1" title="Ver Detalle">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Botón Editar --}}
                                <a href="{{ route('Subalternativaep.edit', $item->NIS) }}"
                                   class="btn btn-warning btn-sm mr-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Botón Eliminar --}}
                                <form action="{{ route('Subalternativaep.destroy', $item->NIS) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar la subalternativa: {{ $item->Nombre }}?')">
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

        {{-- Paginación estilizada --}}
        <div class="card-footer clearfix">
            <div class="float-right">
                {{ $Subalternativaep->links() }}
            </div>
            <p class="text-muted m-0">
                Mostrando {{ $Subalternativaep->count() }} de {{ $Subalternativaep->total() }} registros
            </p>
        </div>
    </div>
@stop
