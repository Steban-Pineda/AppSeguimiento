@extends('adminlte::page')

@section('title', 'Entes Conformadores')

@section('content_header')
    <h1 style="font-weight:800; color:#00324D;">
        <i class="fas fa-building mr-2" style="color:#39A900;"></i>
        Entes Conformadores
    </h1>
@stop

@section('content')
    <style>
        :root { --sena-green: #39A900; --sena-blue: #00324D; }

        /* Contenedor Principal */
        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            background: transparent;
        }

        .card-custom .card-header {
            background: linear-gradient(135deg, var(--sena-blue) 0%, #005684 100%);
            padding: 20px 28px;
            border: none;
        }

        /* Buscador Estilizado */
        .search-wrapper {
            background: #f8f9fa;
            border-radius: 14px;
            padding: 16px 20px;
            margin-bottom: 20px;
            border: 1px solid #eef0f2;
        }

        .search-wrapper .form-control {
            border: 2px solid #e9ecef;
            border-right: none;
            border-radius: 10px 0 0 10px;
            height: 44px;
            font-size: 0.9rem;
        }

        .search-wrapper .form-control:focus {
            border-color: var(--sena-green);
            box-shadow: none;
            background: #f8fff5;
        }

        /* Botones */
        .btn-registrar {
            background: linear-gradient(135deg, #39A900, #2d8500);
            color: white; border: none; border-radius: 10px;
            font-weight: 700; font-size: 0.85rem; padding: 9px 20px;
            transition: all 0.3s; box-shadow: 0 4px 12px rgba(57,169,0,0.35);
        }

        .btn-registrar:hover {
            transform: translateY(-2px); color: white;
            background: linear-gradient(135deg, #2d8500, #39A900);
        }

        .btn-buscar {
            background: var(--sena-blue); color: white; border: none;
            border-radius: 0 10px 10px 0; height: 44px; padding: 0 20px;
        }

        /* Tabla Estilo Moderno */
        .table-custom { border-collapse: separate; border-spacing: 0 8px; width: 100%; }

        .table-custom thead tr th {
            background: #f1f4f8; color: #6c757d;
            font-size: 0.72rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.8px;
            border: none; padding: 12px 16px;
        }

        .table-custom tbody tr {
            background: white;
            transition: all 0.25s;
        }

        .table-custom tbody tr:hover {
            transform: scale(1.005);
            box-shadow: 0 6px 20px rgba(0,50,77,0.08);
        }

        .table-custom tbody tr td {
            border: none; padding: 16px;
            vertical-align: middle; font-size: 0.88rem;
        }

        .table-custom tbody tr td:first-child { border-radius: 12px 0 0 12px; }
        .table-custom tbody tr td:last-child  { border-radius: 0 12px 12px 0; }

        /* Badges y Detalles */
        .nis-badge {
            background: #e8f0fe; color: #1a56db;
            font-weight: 700; padding: 5px 12px; border-radius: 8px;
        }

        .razon-social { font-weight: 700; color: var(--sena-blue); display: block; }
        .identificacion { color: #39A900; font-weight: 600; font-size: 0.8rem; }

        /* Botones Acción */
        .btn-ver, .btn-editar, .btn-borrar, .btn-pdf {
            width: 34px; height: 34px; display: inline-flex;
            align-items: center; justify-content: center;
            border-radius: 8px; border: none; transition: all 0.2s;
        }
        .btn-ver    { background:#e8f4fd; color:#1a8fe3; }
        .btn-editar { background:#fff8e1; color:#f59e0b; }
        .btn-borrar { background:#fde8e8; color:#e53e3e; }
        .btn-pdf    { background:#fee2e2; color:#dc2626; }

        .btn-ver:hover, .btn-editar:hover, .btn-borrar:hover, .btn-pdf:hover {
            transform: translateY(-3px); color: white;
        }
        .btn-ver:hover { background: #1a8fe3; }
        .btn-editar:hover { background: #f59e0b; }
        .btn-borrar:hover { background: #e53e3e; }
        .btn-pdf:hover { background: #dc2626; }

        /* Paginación */
        .pagination { margin-bottom: 0; }
        .page-item.active .page-link { background-color: var(--sena-blue); border-color: var(--sena-blue); }
    </style>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4"
             style="border-radius:12px; border-left:5px solid #39A900;">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    <div class="card card-custom">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0" style="color:white; font-weight:700;">
                    <i class="fas fa-list-alt mr-2" style="color:#39A900;"></i>
                    Listado General
                </h5>
                <a href="{{ route('enteconformador.create') }}" class="btn btn-registrar">
                    <i class="fas fa-plus-circle mr-2"></i> Registrar Nuevo Ente
                </a>
            </div>
        </div>

        <div class="card-body bg-white p-4">
            {{-- Buscador --}}
            <div class="search-wrapper">
                <form action="{{ route('enteconformador.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="buscar" class="form-control"
                               placeholder="Buscar por Razón Social o NIT..."
                               value="{{ request('buscar') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-buscar px-4">
                                <i class="fas fa-search mr-2"></i> Buscar
                            </button>
                        </div>
                        @if(request('buscar'))
                            <a href="{{ route('enteconformador.index') }}" class="btn btn-outline-secondary ml-2" style="border-radius:10px; display:flex; align-items:center;">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Ente Conformador</th>
                        <th>Contacto</th>
                        <th class="text-center">Documentos</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($enteconformador as $item)
                        <tr>
                            <td><span class="nis-badge">{{ $item->NIS }}</span></td>
                            <td>
                                <span class="razon-social">{{ $item->RazonSocial }}</span>
                                <span class="identificacion">{{ $item->tdoc }}: {{ $item->Numdoc }}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <small><i class="fas fa-phone-alt mr-1 text-muted"></i> {{ $item->Telefono }}</small>
                                    <small><i class="fas fa-envelope mr-1 text-muted"></i> {{ $item->CorreoInstitucional }}</small>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($item->anexo_camara)
                                    <a href="{{ asset('uploads/clientes/camara/' . $item->anexo_camara) }}"
                                       target="_blank" class="btn-pdf" title="Cámara de Comercio">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                @else
                                    <span class="badge badge-light text-muted" style="font-size: 0.7rem;">SIN ANEXO</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center" style="gap:8px;">
                                    <a href="{{ route('enteconformador.show', $item->NIS) }}"
                                       class="btn-ver" title="Ver detalle">
                                        <i class="fas fa-eye fa-sm"></i>
                                    </a>
                                    <a href="{{ route('enteconformador.edit', $item->NIS) }}"
                                       class="btn-editar" title="Editar">
                                        <i class="fas fa-edit fa-sm"></i>
                                    </a>
                                    <form action="{{ route('enteconformador.destroy', $item->NIS) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-borrar"
                                                onclick="return confirm('¿Eliminar el registro de {{ $item->RazonSocial }}?')" title="Eliminar">
                                            <i class="fas fa-trash fa-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fas fa-folder-open mb-3 d-block text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted">No se encontraron entes conformadores con esos criterios.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white border-top-0 px-4 pb-4">
            <div class="d-flex justify-content-between align-items-center">
                <p class="text-muted small mb-0">
                    Mostrando <b>{{ $enteconformador->count() }}</b> de <b>{{ $enteconformador->total() }}</b> registros.
                </p>
                <div>
                    {{ $enteconformador->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
