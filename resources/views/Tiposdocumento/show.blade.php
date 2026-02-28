@extends('adminlte::page')

@section('title', 'Detalle del Tipo de Documento')

@section('content_header')
    <h1>Detalle del Registro: {{ $tiposdocumento->NIS }}</h1>
@stop

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Información Completa</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong><i class="fas fa-fingerprint mr-1"></i> NIS (Identificador)</strong>
                    <p class="text-muted">{{ $tiposdocumento->NIS }}</p>
                    <hr>

                    <strong><i class="fas fa-file-alt mr-1"></i> Denominación</strong>
                    <p class="text-muted">{{ $tiposdocumento->Denominacion }}</p>
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-comments mr-1"></i> Observaciones</strong>
                    <p class="text-muted">
                        {{ $tiposdocumento->Observaciones ?? 'Sin observaciones registradas.' }}
                    </p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('tiposdocumento.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver a la lista
            </a>
            <a href="{{ route('tiposdocumento.edit', $tiposdocumento->NIS) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar este registro
            </a>
        </div>
    </div>
@stop
