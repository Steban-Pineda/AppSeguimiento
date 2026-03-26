@extends('adminlte::page')

@section('title', 'Lista de Fichas')

@section('content_header')
    <h1 style="font-weight:800; color:#00324D;">
        <i class="fas fa-id-card mr-2" style="color:#39A900;"></i>
        Fichas de Caracterización
    </h1>
@stop

@section('content')
    <style>
        :root { --sena-green: #39A900; --sena-blue: #00324D; }

        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .card-custom .card-header {
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
            transform: translateY(-2px); color: white;
            background: linear-gradient(135deg, #2d8500, #39A900);
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
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,50,77,0.1);
        }

        .table-custom tbody tr td {
            border: none; padding: 14px 16px;
            vertical-align: middle; font-size: 0.88rem;
        }

        .table-custom tbody tr td:first-child { border-radius: 12px 0 0 12px; }
        .table-custom tbody tr td:last-child  { border-radius: 0 12px 12px 0; }

        /* Badges y Textos */
        .nis-badge {
            background: #e8f0fe; color: #1a56db;
            font-weight: 700; padding: 4px 10px; border-radius: 8px;
        }

        .codigo-text { font-weight: 800; color: var(--sena-blue); }
        .denominacion-text { font-weight: 600; color: #4a5568; display: block; }

        .info-secundaria { font-size: 0.78rem; color: #718096; line-height: 1.2; }
        .fecha-badge { background: #f7fafc; border: 1px solid #edf2f7; padding: 2px 6px; border-radius: 4px; font-weight: 600; }

        /* Botones Acción */
        .btn-ver, .btn-editar, .btn-borrar {
            width: 34px; height: 34px; display: inline-flex;
            align-items: center; justify-content: center;
            border-radius: 8px; border: none; transition: all 0.2s;
        }
        .btn-ver    { background:#e8f4fd; color:#1a8fe3; }
        .btn-editar { background:#fff8e1; color:#f59e0b; }
        .btn-borrar { background:#fde8e8; color:#e53e3e; }

        .btn-ver:hover    { background:#1a8fe3; color:white; transform:scale(1.1); }
        .btn-editar:hover { background:#f59e0b; color:white; transform:scale(1.1); }
        .btn-borrar:hover { background:#e53e3e; color:white; transform:scale(1.1); }
    </style>

    <div class="card card-custom">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0" style="color:white; font-weight:700;">
                    <i class="fas fa-th-list mr-2" style="color:#39A900;"></i>
                    Listado de Fichas
                </h5>
                <a href="{{ route('Fichadecaracterizacion.create') }}" class="btn btn-registrar">
                    <i class="fas fa-plus-circle mr-2"></i> Agregar Nueva Ficha
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                    <tr>
                        <th>NIS / Código</th>
                        <th>Denominación</th>
                        <th>Fechas de Formación</th>
                        <th>Programa / Centro</th>
                        <th class="text-center">Cupo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fichadecaracterizacion as $item)
                        <tr>
                            <td>
                                <span class="nis-badge mb-1 d-inline-block">{{ $item->NIS }}</span><br>
                                <span class="codigo-text">{{ $item->Codigo }}</span>
                            </td>
                            <td>
                                <span class="denominacion-text">{{ $item->Denominacion }}</span>
                            </td>
                            <td>
                                <div class="info-secundaria">
                                    <span class="text-success"><i class="fas fa-calendar-alt"></i> Inicio:</span>
                                    <span class="fecha-badge">{{ $item->fechaInicio }}</span><br>
                                    <span class="text-danger"><i class="fas fa-calendar-check"></i> Fin:</span>
                                    <span class="fecha-badge">{{ $item->fechaFin }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="info-secundaria">
                                    <i class="fas fa-graduation-cap text-muted"></i> {{ $item->programa->Denominacion ?? 'Sin Programa' }}<br>
                                    <i class="fas fa-building text-muted"></i> {{ $item->centro->Denominacion ?? 'Sin Centro' }}
                                </div>
                            </td>
                            <td class="text-center">
                                    <span class="badge badge-pill" style="background:#e8fdf0; color:#10b981; font-weight:700; padding:6px 12px;">
                                        {{ $item->Cupo }}
                                    </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center" style="gap:6px;">
                                    <a href="{{ route('Fichadecaracterizacion.show', ['Fichadecaracterizacion' => $item->NIS]) }}"
                                       class="btn-ver" title="Ver Detalle">
                                        <i class="fas fa-eye fa-sm"></i>
                                    </a>
                                    <a href="{{ route('Fichadecaracterizacion.edit', ['Fichadecaracterizacion' => $item->NIS]) }}"
                                       class="btn-editar" title="Editar">
                                        <i class="fas fa-edit fa-sm"></i>
                                    </a>
                                    <form action="{{ route('Fichadecaracterizacion.destroy', ['Fichadecaracterizacion' => $item->NIS]) }}"
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-borrar" title="Eliminar"
                                                onclick="return confirm('¿Está seguro de eliminar esta ficha?')">
                                            <i class="fas fa-trash fa-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
