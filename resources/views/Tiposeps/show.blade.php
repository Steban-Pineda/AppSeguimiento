@extends('adminlte::page')

@section('title', 'Detalle de la EPS')

@section('content_header')
    <h1>Detalle del Tipo de EPS: {{ $tiposep->Denominacion }}</h1>
@stop

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Información del Registro</h3>
        </div>

        <div class="card-body">
            <div class="row">
                {{-- Columna Izquierda --}}
                <div class="col-md-6">
                    <strong><i class="fas fa-fingerprint mr-1"></i> NIS (ID Sistema)</strong>
                    <p class="text-muted">
                        {{ $tiposep->NIS }}
                        <span class="badge badge-secondary">Autoincremental</span>
                    </p>
                    <hr>

                    <strong><i class="fas fa-id-card mr-1"></i> Número de Documento</strong>
                    <p class="text-muted">{{ $tiposep->numdoc }}</p>
                </div>

                {{-- Columna Derecha --}}
                <div class="col-md-6">
                    <strong><i class="fas fa-hospital mr-1"></i> Denominación</strong>
                    <p class="text-muted">{{ $tiposep->Denominacion }}</p>
                    <hr>

                    <strong><i class="fas fa-comment-alt mr-1"></i> Observaciones</strong>
                    <p class="text-muted">
                        {{ $tiposep->Observaciones ?: 'Sin observaciones adicionales.' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('tiposeps.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver a la lista
            </a>

            <a href="{{ route('tiposeps.edit', $tiposep->NIS) }}" class="btn btn-warning text-white">
                <i class="fas fa-edit"></i> Editar Datos
            </a>
        </div>
    </div>
@stop
