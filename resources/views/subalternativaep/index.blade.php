@extends('adminlte::page')

@section('title', 'Subalternativas EP')

@section('content_header')
    <h1 style="font-weight:800; color:#00324D;">
        <i class="fas fa-sitemap mr-2" style="color:#39A900;"></i>
        Subalternativas Etapa Productiva
    </h1>
@stop

@section('content')
    <style>
        :root { --sena-green: #39A900; --sena-blue: #00324D; }

        .card-subalternativas {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .card-subalternativas .card-header {
            background: linear-gradient(135deg, var(--sena-blue) 0%, #005684 100%);
            padding: 20px 28px;
            border: none;
        }

        .btn-registrar {
            background: linear-gradient(135deg, #39A900, #2d8500);
            color: white; border: none; border-radius: 10px;
            font-weight: 700; font-size: 0.85rem; padding: 9px 20px;
            transition: all 0.3s; box-shadow: 0 4px 12px rgba(57,169,0,0.35);
        }

        .btn-registrar:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(57,169,0,0.45);
            color: white;
            background: linear-gradient(135deg, #2d8500, #39A900);
        }

        .search-wrapper {
            background: #f8f9fa;
            border-radius: 14px;
            padding: 16px 20px;
            margin-bottom: 20px;
            border: 1px solid #eef0f2;
        }

        .search-wrapper .form-control {
            border: 2px solid #e9ecef; border-right: none;
            border-radius: 10px 0 0 10px; height: 44px;
            font-size: 0.9rem; color: var(--sena-blue); transition: all 0.3s;
        }

        .search-wrapper .form-control:focus {
            border-color: var(--sena-green); box-shadow: none; background: #f8fff5;
        }

        .btn-buscar {
            background: var(--sena-blue); color: white; border: none;
            border-radius: 0 10px 10px 0; height: 44px; padding: 0 20px;
            font-weight: 600; font-size: 0.85rem; transition: all 0.3s;
        }

        .btn-buscar:hover { background: var(--sena-green); color: white; }

        .btn-limpiar {
            background: #6c757d; color: white; border: none; border-radius: 10px;
            height: 44px; padding: 0 16px; font-size: 0.85rem; margin-left: 6px; transition: all 0.3s;
        }

        .table-subalternativas { border-collapse: separate; border-spacing: 0 6px; width: 100%; }

        .table-subalternativas thead tr th {
            background: #f1f4f8; color: #6c757d;
            font-size: 0.72rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.8px;
            border: none; padding: 12px 16px;
        }

        .table-subalternativas tbody tr {
            background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.04); transition: all 0.25s;
        }

        .table-subalternativas tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,50,77,0.1);
        }

        .table-subalternativas tbody tr td { border: none; padding: 14px 16px; vertical-align: middle; font-size: 0.88rem; }

        .nis-badge {
            background: linear-gradient(135deg, #e8f0fe, #d2e3fc);
            color: #1a56db; font-weight: 700; font-size: 0.82rem;
            padding: 5px 12px; border-radius: 8px; display: inline-block;
        }

        .nombre-text { font-weight: 600; color: var(--sena-blue); font-size: 0.9rem; }
        .desc-text { color: #6c757d; font-size: 0.82rem; }

        .btn-ver    { background:#e8f4fd; color:#1a8fe3; border:none; border-radius:8px; width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center; transition:all 0.2s; }
        .btn-editar { background:#fff8e1; color:#f59e0b; border:none; border-radius:8px; width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center; transition:all 0.2s; }
        .btn-borrar { background:#fde8e8; color:#e53e3e; border:none; border-radius:8px; width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center; transition:all 0.2s; }

        .btn-ver:hover, .btn-editar:hover, .btn-borrar:hover { transform:scale(1.1); color:white; }
        .btn-ver:hover { background:#1a8fe3; }
        .btn-editar:hover { background:#f59e0b; }
        .btn-borrar:hover { background:#e53e3e; }

        .footer-info {
            background: #f8f9fa; border-radius: 0 0 16px 16px;
            padding: 14px 20px; display: flex; justify-content: space-between;
            align-items: center; border-top: 1px solid #eef0f2;
        }

        .pagination .page-link { border-radius: 8px !important; margin: 0 2px; border: none; color: var(--sena-blue); font-weight: 600; }
        .pagination .page-item.active .page-link { background: var(--sena-blue); color: white; }
    </style>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" style="border-radius:12px; border-left:5px solid #39A900;">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    <div class="card card-subalternativas">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0" style="color:white; font-weight:700; display:flex; align-items:center; gap:10px;">
                    <i class="fas fa-list" style="color:#39A900;"></i>
                    Listado de Subalternativas
                </h5>
                <a href="{{ route('Subalternativaep.create') }}" class="btn btn-registrar">
                    <i class="fas fa-plus-circle mr-2"></i> Agregar Nueva Subalternativa
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            {{-- Buscador --}}
            <div class="search-wrapper">
                <form action="{{ route('Subalternativaep.index') }}" method="GET">
                    <div class="d-flex align-items-center">
                        <div class="input-group flex-grow-1">
                            <input type="text" name="buscar" class="form-control"
                                   placeholder="🔍  Buscar por Nombre, Descripción o NIS..."
                                   value="{{ request('buscar') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-buscar">
                                    <i class="fas fa-search mr-1"></i> Buscar
                                </button>
                            </div>
                        </div>
                        @if(request('buscar'))
                            <a href="{{ route('Subalternativaep.index') }}" class="btn btn-limpiar ml-2">
                                <i class="fas fa-times mr-1"></i> Limpiar
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Tabla --}}
            <div class="table-responsive">
                <table class="table table-subalternativas">
                    <thead>
                    <tr>
                        <th style="width: 100px;">NIS</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($Subalternativaep as $item)
                        <tr>
                            <td><span class="nis-badge">{{ $item->NIS }}</span></td>
                            <td><span class="nombre-text">{{ $item->Nombre }}</span></td>
                            <td><span class="desc-text">{{ Str::limit($item->Descripcion, 60) }}</span></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center" style="gap:6px;">
                                    <a href="{{ route('Subalternativaep.show', $item->NIS) }}" class="btn-ver" title="Ver detalle">
                                        <i class="fas fa-eye fa-sm"></i>
                                    </a>
                                    <a href="{{ route('Subalternativaep.edit', $item->NIS) }}" class="btn-editar" title="Editar">
                                        <i class="fas fa-edit fa-sm"></i>
                                    </a>
                                    <form action="{{ route('Subalternativaep.destroy', $item->NIS) }}" method="POST" style="display:inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-borrar" title="Eliminar"
                                                onclick="return confirm('¿Eliminar la subalternativa {{ $item->Nombre }}?')">
                                            <i class="fas fa-trash fa-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3"></i>
                                    <p>No se encontraron subalternativas con ese criterio.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer con paginación --}}
        <div class="footer-info">
            <span class="text-muted small">
                <i class="fas fa-info-circle mr-1"></i>
                Mostrando {{ $Subalternativaep->firstItem() }} al {{ $Subalternativaep->lastItem() }} de {{ $Subalternativaep->total() }} registros
            </span>
            <div>{{ $Subalternativaep->appends(request()->query())->links() }}</div>
        </div>
    </div>
@stop
