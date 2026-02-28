@extends('adminlte::page')

@section('title', 'Entes Conformadores')

@section('content_header')
    <h1>Lista de Entes Conformadores</h1>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <a href="{{ route('enteconformador.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Registrar Nuevo Ente
            </a>

            <div class="card-tools">
                {{-- Formulario de búsqueda conectado al controlador --}}
                <form action="{{ route('enteconformador.index') }}" method="GET" class="input-group input-group-sm" style="width: 280px;">
                    <input type="text" name="buscar" class="form-control"
                           placeholder="Buscar por Razón Social o NIT..."
                           value="{{ request('buscar') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body p-0">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-2">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fas fa-check"></i> {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-light">
                    <tr>
                        <th style="width: 50px;">NIS</th>
                        <th>Identificación</th>
                        <th>Razón Social</th>
                        <th>Contacto</th>
                        <th class="text-center">PDF</th>
                        <th style="width: 150px;" class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($enteconformador as $item)
                        <tr>
                            <td><span class="badge badge-secondary">{{ $item->NIS }}</span></td>
                            <td><strong>{{ $item->tdoc }}</strong> - {{ $item->Numdoc }}</td>
                            <td>{{ $item->RazonSocial }}</td>
                            <td>
                                <small>
                                    <i class="fas fa-phone text-muted"></i> {{ $item->Telefono }}<br>
                                    <i class="fas fa-envelope text-muted"></i> {{ $item->CorreoInstitucional }}
                                </small>
                            </td>
                            <td class="text-center">
                                @if($item->anexo_camara)
                                    <a href="{{ asset('uploads/clientes/camara/' . $item->anexo_camara) }}"
                                       target="_blank"
                                       class="btn btn-outline-danger btn-sm"
                                       title="Ver Cámara de Comercio">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                @else
                                    <span class="text-muted small">N/A</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('enteconformador.show', $item->NIS) }}"
                                       class="btn btn-info btn-sm" title="Ver detalle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('enteconformador.edit', $item->NIS) }}"
                                       class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('enteconformador.destroy', $item->NIS) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Eliminar el registro de {{ $item->RazonSocial }}?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                No se encontraron entes conformadores registrados.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Paginación estilizada --}}
        <div class="card-footer clearfix">
            <div class="float-right">
                {{ $enteconformador->links() }}
            </div>
            <p class="text-muted m-0 small">
                Total: {{ $enteconformador->total() }} registros.
            </p>
        </div>
    </div>
@stop
