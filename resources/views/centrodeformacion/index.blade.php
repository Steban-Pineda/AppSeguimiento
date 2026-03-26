@extends('adminlte::page')

@section('title', 'Lista de Centros')

@section('content_header')
    <h1 style="font-weight:800; color:#00324D;">
        <i class="fas fa-university mr-2" style="color:#39A900;"></i>
        Centros de Formación
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

        /* Estilos de Tabla */
        .table-custom { border-collapse: separate; border-spacing: 0 6px; width: 100% !important; border: none !important; }

        .table-custom thead tr th {
            background: #f1f4f8 !important;
            color: #6c757d !important;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border: none !important;
            padding: 12px 16px;
        }

        .table-custom thead tr th:first-child { border-radius: 10px 0 0 10px; }
        .table-custom thead tr th:last-child  { border-radius: 0 10px 10px 0; }

        .table-custom tbody tr {
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: all 0.25s;
        }

        .table-custom tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,50,77,0.1);
        }

        .table-custom tbody tr td {
            border: none !important;
            padding: 14px 16px;
            vertical-align: middle;
            font-size: 0.88rem;
        }

        .table-custom tbody tr td:first-child { border-radius: 10px 0 0 10px; }
        .table-custom tbody tr td:last-child  { border-radius: 0 10px 10px 0; }

        /* Badges y Textos */
        .nis-badge {
            background: linear-gradient(135deg, #e8f0fe, #d2e3fc);
            color: #1a56db;
            font-weight: 700;
            font-size: 0.82rem;
            padding: 5px 12px;
            border-radius: 8px;
            display: inline-block;
        }

        .regional-badge {
            background: #e8fdf0;
            color: #10b981;
            font-weight: 700;
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 6px;
            text-transform: uppercase;
        }

        .main-text { font-weight: 600; color: var(--sena-blue); }
        .sub-text { color: #6c757d; font-size: 0.82rem; }

        /* Botones de Acción */
        .btn-ver    { background:#e8f4fd; color:#1a8fe3; border:none; border-radius:8px; width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center; transition:all 0.2s; }
        .btn-editar { background:#fff8e1; color:#f59e0b; border:none; border-radius:8px; width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center; transition:all 0.2s; }
        .btn-borrar { background:#fde8e8; color:#e53e3e; border:none; border-radius:8px; width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center; transition:all 0.2s; }

        .btn-ver:hover    { background:#1a8fe3; color:white; transform:scale(1.1); }
        .btn-editar:hover { background:#f59e0b; color:white; transform:scale(1.1); }
        .btn-borrar:hover { background:#e53e3e; color:white; transform:scale(1.1); }

        /* Ajuste DataTables */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--sena-blue) !important;
            color: white !important;
            border: none;
            border-radius: 8px;
        }
    </style>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm"
             style="border-radius:12px; border-left:5px solid #39A900;" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    <div class="card card-custom">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0" style="color:white; font-weight:700; display:flex; align-items:center; gap:10px;">
                    <i class="fas fa-list-ul" style="color:#39A900;"></i>
                    Registros de Centros
                </h5>
                <a href="{{ route('Centrodeformacion.create') }}" class="btn btn-registrar">
                    <i class="fas fa-plus-circle mr-2"></i> Agregar Centro
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="tabla-centros" class="table table-custom">
                    <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Código</th>
                        <th>Denominación</th>
                        <th>Dirección</th>
                        <th>Regional</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Centrodeformacion as $item)
                        <tr>
                            <td><span class="nis-badge">{{ $item->NIS }}</span></td>
                            <td class="main-text">{{ $item->Codigo }}</td>
                            <td class="main-text">{{ $item->Denominacion }}</td>
                            <td class="sub-text">{{ $item->Direccion }}</td>
                            <td>
                                    <span class="regional-badge">
                                        {{ $item->regional->Denominacion ?? 'Sin regional' }}
                                    </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center" style="gap:6px;">
                                    <a href="{{ route('Centrodeformacion.show', $item->NIS) }}"
                                       class="btn-ver" title="Ver detalle">
                                        <i class="fas fa-eye fa-sm"></i>
                                    </a>
                                    <a href="{{ route('Centrodeformacion.edit', $item->NIS) }}"
                                       class="btn-editar" title="Editar">
                                        <i class="fas fa-edit fa-sm"></i>
                                    </a>
                                    <form action="{{ route('Centrodeformacion.destroy', $item->NIS) }}"
                                          method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-borrar" title="Eliminar"
                                                onclick="return confirm('¿Desea eliminar este centro?')">
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

@section('js')
    <script>
        $(document).ready(function() {
            $('#tabla-centros').DataTable({
                "responsive": true,
                "autoWidth": false,
                "dom": '<"d-flex justify-content-between mb-3"f>rt<"d-flex justify-content-between mt-3"ip>',
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                }
            });
        });
    </script>
@stop
