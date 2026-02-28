@extends('adminlte::page')

@section('title', 'Detalle de la Regional')

@section('content_header')
    <h1>Detalle de la Regional: {{ $Regional->Denominacion }}</h1>
@stop

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Información General del Registro</h3>
        </div>

        <div class="card-body">
            <div class="row">
                {{-- Columna Izquierda --}}
                <div class="col-md-6">
                    <strong><i class="fas fa-fingerprint mr-1"></i> NIS (Identificador)</strong>
                    <p class="text-muted">{{ $Regional->NIS }}</p>
                    <hr>

                    <strong><i class="fas fa-barcode mr-1"></i> Código de la Regional</strong>
                    <p class="text-muted">{{ $Regional->Codigo }}</p>
                </div>

                {{-- Columna Derecha --}}
                <div class="col-md-6">
                    <strong><i class="fas fa-map-marked-alt mr-1"></i> Denominación / Nombre</strong>
                    <p class="text-muted">{{ $Regional->Denominacion }}</p>
                    <hr>

                    <strong><i class="fas fa-align-left mr-1"></i> Observaciones</strong>
                    <p class="text-muted">
                        {{ $Regional->Observaciones ?? 'Sin observaciones registradas.' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('Regional.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver a la lista
            </a>

            <a href="{{ route('Regional.edit', $Regional->NIS) }}" class="btn btn-warning text-white">
                <i class="fas fa-edit"></i> Editar Regional
            </a>
        </div>
    </div>
@stop
