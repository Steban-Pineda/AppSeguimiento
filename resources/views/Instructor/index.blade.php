@extends('adminlte::page')

@section('title', 'Lista de Instructores')

@section('content_header')
    <h1 style="font-weight:800; color:#00324D;">
        <i class="fas fa-chalkboard-teacher mr-2" style="color:#39A900;"></i>
        Gestión de Instructores
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
        .table-custom { border-collapse: separate; border-spacing: 0 8px; width: 100% !important; border: none !important; }

        .table-custom thead tr th {
            background: #f1f4f8 !important;
            color: #6c757d !important;
            font-size: 0.72rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.8px;
            border: none !important; padding: 12px 16px;
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
            border: none !important; padding: 14px 16px;
            vertical-align: middle; font-size: 0.88rem;
        }

        .table-custom tbody tr td:first-child { border-radius: 12px 0 0 12px; }
        .table-custom tbody tr td:last-child  { border-radius: 0 12px 12px 0; }

        /* Badges y Textos */
        .nis-badge {
            background: #e8f0fe; color: #1a56db;
            font-weight: 700; padding: 4px 10px; border-radius: 8px;
        }

        .instructor-name { font-weight: 700; color: var(--sena-blue); display: block; }
        .doc-text { color: #39A900; font-weight: 600; font-size: 0.8rem; }

        .contact-info { font-size: 0.82rem; color: #6c757d; }

        .role-badge { background: #e0f2fe; color: #0369a1; font-weight: 700; font-size: 0.75rem; padding: 4px 10px; border-radius: 6px; }
        .eps-badge { background: #f3f4f6; color: #4b5563; font-weight: 600; font-size: 0.75rem; padding: 4px 10px; border-radius: 6px; }

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

        /* DataTables Custom */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--sena-blue) !important; color: white !important; border: none; border-radius: 8px;
        }
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
                    <i class="fas fa-users mr-2" style="color:#39A900;"></i>
                    Listado de Instructores
                </h5>
                <a href="{{ route('Instructor.create') }}" class="btn btn-registrar">
                    <i class="fas fa-user-plus mr-2"></i> Agregar Instructor
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="tabla-instructores" class="table table-custom">
                    <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Identificación</th>
                        <th>Nombre Completo</th>
                        <th>Contacto</th>
                        <th>Rol / EPS</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Instructor as $item)
                        <tr>
                            <td><span class="nis-badge">{{ $item->NIS }}</span></td>
                            <td>
                                <span class="doc-text">{{ $item->tipoDocumento->Denominacion ?? 'N/A' }}</span><br>
                                <span style="font-weight: 700;">{{ $item->Numdoc }}</span>
                            </td>
                            <td>
                                <span class="instructor-name">{{ $item->Nombres }} {{ $item->Apellidos }}</span>
                            </td>
                            <td>
                                <div class="contact-info">
                                    <i class="fas fa-phone-alt fa-xs mr-1"></i> {{ $item->Telefono }}<br>
                                    <i class="fas fa-envelope fa-xs mr-1"></i> {{ $item->CorreoInstitucional }}
                                </div>
                            </td>
                            <td>
                                    <span class="role-badge d-block mb-1 text-center">
                                        {{ $item->rolesadministrativos->Descripcion ?? 'Sin Rol' }}
                                    </span>
                                <span class="eps-badge d-block text-center">
                                        {{ $item->eps->Denominacion ?? 'Sin EPS' }}
                                    </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center" style="gap:6px;">
                                    <a href="{{ route('Instructor.show', $item->NIS) }}"
                                       class="btn-ver" title="Ver Detalle">
                                        <i class="fas fa-eye fa-sm"></i>
                                    </a>
                                    <a href="{{ route('Instructor.edit', $item->NIS) }}"
                                       class="btn-editar" title="Editar">
                                        <i class="fas fa-edit fa-sm"></i>
                                    </a>
                                    <form action="{{ route('Instructor.destroy', $item->NIS) }}"
                                          method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-borrar" title="Eliminar"
                                                onclick="return confirm('¿Está seguro de eliminar este instructor?')">
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
            $('#tabla-instructores').DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[2, "asc"]],
                "dom": '<"d-flex justify-content-between mb-3"f>rt<"d-flex justify-content-between mt-3"ip>',
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                }
            });
        });
    </script>
@stop
