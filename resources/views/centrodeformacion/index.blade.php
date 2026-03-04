@extends('adminlte::page')

@section('title', 'Lista de Centros')

@section('content_header')
    <h1>Lista de Centros de Formación</h1>
@stop

@section('content')
    {{-- Alerta de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('Centrodeformacion.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Agregar Nuevo Registro
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabla-centros" class="table table-bordered table-striped">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th style="width: 50px">NIS</th>
                        <th>Código</th>
                        <th>Denominación</th>
                        <th>Dirección</th>
                        <th>Regional</th> {{-- Aquí mostramos el nombre --}}
                        <th style="width: 120px">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Centrodeformacion as $item)
                        <tr>
                            <td>{{ $item->NIS }}</td>
                            <td>{{ $item->Codigo }}</td>
                            <td>{{ $item->Denominacion }}</td>
                            <td>{{ $item->Direccion }}</td>
                            {{-- Accedemos a la relación 'regional' definida en el modelo --}}
                            <td>
                                <span class="badge badge-info">
                                    {{ $item->regional->Denominacion ?? 'Sin regional' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('Centrodeformacion.show', $item->NIS) }}"
                                       class="btn btn-info btn-sm mr-1" title="Ver Detalle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                <div class="btn-group">
                                    <a href="{{ route('Centrodeformacion.edit', $item->NIS) }}"
                                       class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('Centrodeformacion.destroy', $item->NIS) }}"
                                          method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Desea eliminar este centro?')" title="Eliminar">
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
    <script>
        $(document).ready(function() {
            $('#tabla-centros').DataTable({
                "responsive": true,
                "autoWidth": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                }
            });
        });
    </script>
@stop
