@extends('adminlte::page')

@section('title', 'Lista de Aprendices')

@section('content_header')
    <h1 class="section-title">
        <i class="fas fa-user-graduate"></i>
        {{ auth()->user()->role === 3 ? 'Mi Perfil de Aprendiz' : 'Gestión de Aprendices' }}
    </h1>
@stop

@section('content')
    <style>
        :root { --sena-green: #39A900; --sena-blue: #00324D; }

        .section-title {
            font-weight: 800;
            color: var(--sena-blue);
            display: flex;
            align-items: center;
            font-size: 1.4rem;
        }
        .section-title i { margin-right: 12px; color: var(--sena-green); }

        /* ── Card principal ── */
        .card-aprendices {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .card-aprendices .card-header {
            background: linear-gradient(135deg, var(--sena-blue) 0%, #005684 100%);
            padding: 20px 28px;
            border: none;
        }

        .card-header-title {
            color: white;
            font-weight: 700;
            font-size: 1rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header-title i { color: #39A900; font-size: 1.1rem; }

        .btn-registrar {
            background: linear-gradient(135deg, #39A900, #2d8500);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 9px 20px;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(57,169,0,0.35);
        }

        .btn-registrar:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(57,169,0,0.45);
            color: white;
            background: linear-gradient(135deg, #2d8500, #39A900);
        }

        /* ── Buscador ── */
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
            color: var(--sena-blue);
            transition: all 0.3s;
        }

        .search-wrapper .form-control:focus {
            border-color: var(--sena-green);
            box-shadow: none;
            background: #f8fff5;
        }

        .btn-buscar {
            background: var(--sena-blue);
            color: white;
            border: none;
            border-radius: 0 10px 10px 0;
            height: 44px;
            padding: 0 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .btn-buscar:hover { background: var(--sena-green); color: white; }

        .btn-limpiar {
            background: #6c757d;
            color: white;
            border: none;
            border-radius: 10px;
            height: 44px;
            padding: 0 16px;
            font-size: 0.85rem;
            margin-left: 6px;
            transition: all 0.3s;
        }

        .btn-limpiar:hover { background: #5a6268; color: white; }

        /* ── Tabla ── */
        .table-aprendices { border-collapse: separate; border-spacing: 0 6px; }

        .table-aprendices thead tr th {
            background: #f1f4f8;
            color: #6c757d;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border: none;
            padding: 12px 16px;
        }

        .table-aprendices thead tr th:first-child { border-radius: 10px 0 0 10px; }
        .table-aprendices thead tr th:last-child  { border-radius: 0 10px 10px 0; }

        .table-aprendices tbody tr {
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: all 0.25s;
            border-radius: 10px;
        }

        .table-aprendices tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,50,77,0.1);
        }

        .table-aprendices tbody tr td {
            border: none;
            padding: 14px 16px;
            vertical-align: middle;
            font-size: 0.88rem;
        }

        .table-aprendices tbody tr td:first-child { border-radius: 10px 0 0 10px; }
        .table-aprendices tbody tr td:last-child  { border-radius: 0 10px 10px 0; }

        /* ── Badges y chips ── */
        .numdoc-badge {
            background: linear-gradient(135deg, #e8f0fe, #d2e3fc);
            color: #1a56db;
            font-weight: 700;
            font-size: 0.82rem;
            padding: 5px 12px;
            border-radius: 8px;
            display: inline-block;
        }

        .nombre-text {
            font-weight: 600;
            color: var(--sena-blue);
            font-size: 0.9rem;
        }

        .correo-institucional {
            background: #e8f5e9;
            color: #2d8500;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 6px;
            display: inline-block;
            margin-bottom: 3px;
        }

        .correo-personal {
            color: #6c757d;
            font-size: 0.75rem;
        }

        .ficha-badge {
            background: linear-gradient(135deg, var(--sena-blue), #005684);
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 8px;
            display: inline-block;
        }

        .eps-text {
            color: #495057;
            font-size: 0.82rem;
            font-weight: 500;
        }

        .telefono-text {
            color: #495057;
            font-size: 0.85rem;
        }

        /* ── Botones de acción ── */
        .btn-ver    { background:#e8f4fd; color:#1a8fe3; border:none; border-radius:8px; width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center; transition:all 0.2s; }
        .btn-editar { background:#fff8e1; color:#f59e0b; border:none; border-radius:8px; width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center; transition:all 0.2s; }
        .btn-borrar { background:#fde8e8; color:#e53e3e; border:none; border-radius:8px; width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center; transition:all 0.2s; }

        .btn-ver:hover    { background:#1a8fe3; color:white; transform:scale(1.1); }
        .btn-editar:hover { background:#f59e0b; color:white; transform:scale(1.1); }
        .btn-borrar:hover { background:#e53e3e; color:white; transform:scale(1.1); }

        /* ── Empty state ── */
        .empty-state {
            padding: 50px 20px;
            text-align: center;
            color: #adb5bd;
        }
        .empty-state i { font-size: 3rem; margin-bottom: 12px; display: block; }
        .empty-state p { font-size: 0.95rem; margin: 0; }

        /* ── Paginación ── */
        .pagination .page-link {
            border-radius: 8px !important;
            margin: 0 2px;
            border: none;
            color: var(--sena-blue);
            font-weight: 600;
            font-size: 0.85rem;
        }
        .pagination .page-item.active .page-link {
            background: var(--sena-blue);
            color: white;
            box-shadow: 0 3px 10px rgba(0,50,77,0.3);
        }
        .pagination .page-link:hover {
            background: var(--sena-green);
            color: white;
        }
    </style>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm"
             style="border-radius:12px; border-left:5px solid #39A900;" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-aprendices">

        {{-- Header --}}
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header-title">
                    <i class="fas fa-users"></i>
                    {{ auth()->user()->role === 3 ? 'Mis Datos Registrados' : 'Registros actuales' }}
                </h5>
                @if(auth()->user()->role !== 3)
                    <a href="{{ route('Aprendices.create') }}" class="btn btn-registrar">
                        <i class="fas fa-plus-circle mr-2"></i> Registrar Aprendiz
                    </a>
                @endif
            </div>
        </div>

        <div class="card-body p-4">

            {{-- Buscador --}}
            <div class="search-wrapper">
                <form method="GET" action="{{ route('Aprendices.index') }}">
                    <div class="d-flex align-items-center">
                        <div class="input-group flex-grow-1">
                            <input type="text"
                                   name="buscar"
                                   class="form-control"
                                   placeholder="🔍  Buscar por NIS, Documento o Ficha..."
                                   value="{{ $buscar ?? '' }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-buscar">
                                    <i class="fas fa-search mr-1"></i> Buscar
                                </button>
                            </div>
                        </div>
                        @if($buscar ?? false)
                            <a href="{{ route('Aprendices.index') }}" class="btn btn-limpiar ml-2">
                                <i class="fas fa-times mr-1"></i> Limpiar
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Tabla --}}
            <div class="table-responsive">
                <table class="table table-aprendices">
                    <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Nombre Completo</th>
                        <th>Contacto</th>
                        <th>Correos</th>
                        <th>Ficha</th>
                        <th>EPS</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($Aprendiz as $item)
                        <tr>
                            <td>
                                <span class="numdoc-badge">{{ $item->Numdoc }}</span>
                            </td>
                            <td>
                                <span class="nombre-text">{{ $item->Nombres }} {{ $item->Apellidos }}</span>
                            </td>
                            <td>
                                <span class="telefono-text">
                                    <i class="fas fa-phone-alt fa-xs mr-1" style="color:#39A900;"></i>
                                    {{ $item->Telefono }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="correo-institucional">
                                        <i class="fas fa-university mr-1"></i>{{ $item->CorreoInstitucional }}
                                    </span>
                                    <span class="correo-personal mt-1">
                                        <i class="fas fa-envelope mr-1"></i>{{ $item->CorreoPersonal ?? 'N/A' }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="ficha-badge">{{ $item->ficha->Denominacion ?? 'Sin asignar' }}</span>
                            </td>
                            <td>
                                <span class="eps-text">{{ $item->eps->Denominacion ?? 'N/A' }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center" style="gap:6px;">
                                    <a href="{{ route('Aprendices.show', $item->NIS) }}"
                                       class="btn-ver" title="Ver detalle">
                                        <i class="fas fa-eye fa-sm"></i>
                                    </a>
                                    <a href="{{ route('Aprendices.edit', $item->NIS) }}"
                                       class="btn-editar" title="Editar">
                                        <i class="fas fa-edit fa-sm"></i>
                                    </a>
                                    @if(auth()->user()->role !== 3)
                                        <form action="{{ route('Aprendices.destroy', $item->NIS) }}"
                                              method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-borrar" title="Eliminar"
                                                    onclick="return confirm('¿Está seguro de eliminar este registro?')">
                                                <i class="fas fa-trash fa-sm"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-user-slash"></i>
                                    <p>No se encontraron aprendices con ese criterio de búsqueda.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $Aprendiz->links() }}
            </div>

        </div>
    </div>
@stop
