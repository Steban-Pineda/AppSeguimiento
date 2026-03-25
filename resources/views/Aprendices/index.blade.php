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
        .section-title { font-weight: 700; color: var(--sena-blue); display: flex; align-items: center; }
        .section-title i { margin-right: 15px; color: var(--sena-green); }
        .card-custom { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border-top: 5px solid var(--sena-green); }
        .table thead { background-color: var(--sena-blue); color: white; }
        .btn-sena-blue { background-color: var(--sena-blue); color: white; border-radius: 8px; font-weight: 600; transition: 0.3s; border: none; }
        .btn-sena-blue:hover { background-color: var(--sena-green); color: white; transform: translateY(-2px); }
        .btn-action { border-radius: 6px; margin: 0 2px; }
    </style>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="icon fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-custom">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-muted">
                    {{ auth()->user()->role === 3 ? 'Mis Datos Registrados' : 'Registros actuales' }}
                </h5>

                {{-- NIVEL 1: Ocultar botón de insertar a Aprendices --}}
                @if(auth()->user()->role !== 3)
                    <a href="{{ route('Aprendices.create') }}" class="btn btn-sena-blue px-4">
                        <i class="fas fa-plus-circle mr-2"></i> Registrar Aprendiz
                    </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                    <tr>
                        <th class="border-0">Documento</th>
                        <th class="border-0">Nombre Completo</th>
                        <th class="border-0">Contacto</th>
                        <th class="border-0">Correos Electrónicos</th>
                        <th class="border-0">Ficha de Formación</th>
                        <th class="border-0">EPS</th>
                        <th class="border-0 text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Aprendiz as $item)
                        <tr>
                            <td class="font-weight-bold text-primary">{{ $item->Numdoc }}</td>
                            <td>{{ $item->Nombres }} {{ $item->Apellidos }}</td>
                            <td><i class="fas fa-phone-alt fa-xs text-muted mr-1"></i> {{ $item->Telefono }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <small class="badge badge-light text-left"><i class="fas fa-university mr-1 text-success"></i> {{ $item->CorreoInstitucional }}</small>
                                    <small class="text-muted mt-1"><i class="fas fa-envelope mr-1"></i> {{ $item->CorreoPersonal ?? 'N/A' }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-info" style="background-color: #005684">
                                    {{ $item->ficha->Denominacion ?? 'Sin asignar' }}
                                </span>
                            </td>
                            <td><span class="text-muted small fw-bold">{{ $item->eps->Denominacion ?? 'N/A' }}</span></td>
                            <td class="text-center">
                                <div class="btn-group shadow-sm">
                                    <a href="{{ route('Aprendices.show', $item->NIS) }}" class="btn btn-light btn-sm btn-action text-info" title="Ver detalle">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    {{-- El aprendiz SÍ puede editar su propia info --}}
                                    <a href="{{ route('Aprendices.edit', $item->NIS) }}" class="btn btn-light btn-sm btn-action text-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- NIVEL 2: Ocultar botón de eliminar a Aprendices --}}
                                    @if(auth()->user()->role !== 3)
                                        <form action="{{ route('Aprendices.destroy', $item->NIS) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light btn-sm btn-action text-danger" onclick="return confirm('¿Está seguro de eliminar este registro?')" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
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
