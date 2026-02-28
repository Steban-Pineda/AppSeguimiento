@extends('adminlte::page')

@section('title', 'Detalle del Ente')

@section('content_header')
    <h1>Expediente del Ente Conformador</h1>
@stop

@section('content')
    <div class="card card-outline card-primary shadow">
        <div class="card-header">
            <h3 class="card-title">Información Completa</h3>
            <div class="card-tools">
                <a href="{{ route('enteconformador.index') }}" class="btn btn-default btn-sm">
                    <i class="fas fa-list"></i> Volver al listado
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                {{-- Datos de Identificación --}}
                <div class="col-md-6">
                    <div class="form-group border-bottom pb-2">
                        <label class="text-navy">Razón Social</label>
                        <p class="h5">{{ $ente->RazonSocial }}</p>
                    </div>
                    <div class="form-group border-bottom pb-2">
                        <label class="text-navy">Documento de Identidad</label>
                        <p>{{ $ente->tdoc }} - {{ $ente->Numdoc }}</p>
                    </div>
                    <div class="form-group border-bottom pb-2">
                        <label class="text-navy">NIS (Identificador)</label>
                        <p><span class="badge badge-secondary">{{ $ente->NIS }}</span></p>
                    </div>
                </div>

                {{-- Datos de Contacto y Anexo --}}
                <div class="col-md-6">
                    <div class="form-group border-bottom pb-2">
                        <label class="text-navy">Contacto</label>
                        <p>
                            <i class="fas fa-phone mr-1"></i> {{ $ente->Telefono }}<br>
                            <i class="fas fa-envelope mr-1"></i> {{ $ente->CorreoInstitucional }}
                        </p>
                    </div>
                    <div class="form-group border-bottom pb-2">
                        <label class="text-navy">Dirección</label>
                        <p>{{ $ente->Direccion }}</p>
                    </div>

                    {{-- Sección del Botón del Anexo --}}
                    <div class="form-group">
                        <label class="text-navy d-block">Documentación Adjunta</label>
                        @if($ente->anexo_camara)
                            <a href="{{ asset('uploads/clientes/camara/' . $ente->anexo_camara) }}"
                               target="_blank"
                               class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Ver Cámara de Comercio (PDF)
                            </a>
                        @else
                            <span class="badge badge-warning">
                                <i class="fas fa-exclamation-triangle"></i> Sin anexo cargado
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light">
            <div class="float-right">
                <a href="{{ route('enteconformador.edit', $ente->NIS) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Editar
                </a>

                <form action="{{ route('enteconformador.destroy', $ente->NIS) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este registro?')">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
@stop
