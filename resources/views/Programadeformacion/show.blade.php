@extends('adminlte::page')

@section('title', 'Detalle del Programa')

@section('content_header')
    <h1>Detalle del Programa: {{ $programadeformacion->Denominacion }}</h1>
@stop

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Información del Programa de Formación</h3>
        </div>

        <div class="card-body">
            <div class="row">
                {{-- Columna Izquierda --}}
                <div class="col-md-6">
                    <strong><i class="fas fa-id-card mr-1"></i> NIS (Identificador único)</strong>
                    <p class="text-muted">{{ $programadeformacion->NIS }}</p>
                    <hr>

                    <strong><i class="fas fa-tag mr-1"></i> Código del Programa</strong>
                    <p class="text-muted">{{ $programadeformacion->Codigo }}</p>
                </div>

                {{-- Columna Derecha --}}
                <div class="col-md-6">
                    <strong><i class="fas fa-graduation-cap mr-1"></i> Nombre / Denominación</strong>
                    <p class="text-muted">{{ $programadeformacion->Denominacion }}</p>
                    <hr>

                    <strong><i class="fas fa-comment-dots mr-1"></i> Observaciones</strong>
                    <p class="text-muted">
                        {{ $programadeformacion->Observaciones ?? 'Sin observaciones adicionales.' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('programadeformacion.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver a la lista
            </a>

            <a href="{{ route('programadeformacion.edit', $programadeformacion->NIS) }}" class="btn btn-warning text-white">
                <i class="fas fa-edit"></i> Editar Información
            </a>
        </div>
    </div>
@stop
