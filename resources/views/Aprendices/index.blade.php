@extends('adminlte::page')

@section('title', 'Lista de Aprendices')

@section('content_header')
    <h1>Lista de Aprendices</h1>
@stop

@section('content')
    {{-- Bloque de alertas para mensajes de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="icon fas fa-check"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('Aprendices.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Agregar Nuevo Registro
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th>Documento</th>
                        <th>Nombres y Apellidos</th>
                        <th>Teléfono</th>
                        <th>Correos (Inst. / Pers.)</th> {{-- Columna combinada --}}
                        <th>Ficha</th>
                        <th>EPS</th>
                        <th style="width: 120px">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Aprendiz as $item)
                        <tr>
                            <td>{{ $item->Numdoc }}</td>
                            <td>{{ $item->Nombres }} {{ $item->Apellidos }}</td>
                            <td>{{ $item->Telefono }}</td>
                            <td>
                                <small><strong>Inst:</strong> {{ $item->CorreoInstitucional }}</small><br>
                                <small><strong>Pers:</strong> {{ $item->CorreoPersonal ?? 'N/A' }}</small>
                            </td>
                            <td>{{ $item->ficha->Denominacion ?? 'Sin asignar' }}</td>
                            <td>{{ $item->eps->Denominacion ?? 'Sin asignar' }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('Aprendices.show', $item->NIS) }}" class="btn btn-info btn-sm" title="Ver detalle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('Aprendices.edit', $item->NIS) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('Aprendices.destroy', $item->NIS) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este registro?')" title="Eliminar">
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
