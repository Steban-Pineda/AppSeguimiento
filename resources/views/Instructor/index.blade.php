{{-- Extiende la plantilla base de AdminLTE --}}
@extends('adminlte::page')

@section('title', 'Lista de Instructores')

@section('content_header')
    <h1>Gestión de Instructores</h1>
@stop

@section('content')
    {{-- Alerta de éxito para confirmar acciones del controlador --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
            {{ session('success') }}
        </div>
    @endif

    <div class="card card-outline card-primary">
        <div class="card-header">
            <a href="{{ route('Instructor.create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Agregar Nuevo Instructor
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                {{-- ID 'tabla-instructores' para la inicialización de DataTables --}}
                <table id="tabla-instructores" class="table table-hover table-striped table-bordered">
                    <thead class="bg-navy text-white">
                    <tr>
                        <th>NIS</th>
                        <th>Documento</th>
                        <th>Nombre Completo</th>
                        <th>Contacto</th>
                        <th>Rol Administrativo</th>
                        <th>EPS</th>
                        <th style="width: 100px">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Instructor as $item)
                        <tr>
                            <td>{{ $item->NIS }}</td>
                            <td>
                                {{-- Mostramos el tipo y el número de documento --}}
                                <small class="text-muted">{{ $item->tipoDocumento->Denominacion ?? 'N/A' }}</small><br>
                                <strong>{{ $item->Numdoc }}</strong>
                            </td>
                            <td>{{ $item->Nombres }} {{ $item->Apellidos }}</td>
                            <td>
                                <i class="fas fa-phone fa-sm"></i> {{ $item->Telefono }}<br>
                                <small><i class="fas fa-envelope fa-sm"></i> {{ $item->CorreoInstitucional }}</small>
                            </td>
                            <td>
                                {{-- Relación con Roles Administrativos --}}
                                <span class="badge badge-primary">
                                    {{ $item->rolesadministrativos->Descripcion ?? 'Sin Rol' }}
                                </span>
                            </td>
                            <td>
                                {{-- Relación con EPS --}}
                                <span class="badge badge-secondary">
                                    {{ $item->eps->Denominacion ?? 'Sin EPS' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('Instructor.show', $item->NIS) }}"
                                       class="btn btn-info btn-sm mr-1" title="Ver Detalle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                <div class="btn-group">
                                    {{-- Botón Editar --}}
                                    <a href="{{ route('Instructor.edit', $item->NIS) }}"
                                       class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Formulario para eliminar con confirmación --}}
                                    <form action="{{ route('Instructor.destroy', $item->NIS) }}"
                                          method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Está seguro de eliminar este instructor?')" title="Eliminar">
                                            <i class="fas fa-trash"></i>
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
    {{-- Configuración de DataTables --}}
    <script>
        $(document).ready(function() {
            $('#tabla-instructores').DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[2, "asc"]], // Ordenar por nombre por defecto
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                }
            });
        });
    </script>
@stop
