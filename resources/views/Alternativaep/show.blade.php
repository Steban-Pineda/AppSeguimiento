@extends('adminlte::page')

@section('title', 'Detalle de Alternativa EP')

@section('content_header')
    <h1>Detalle de Alternativa: {{ $alternativaep->NIS }}</h1>
@stop

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Información Completa de la Alternativa</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    {{-- Campo NIS --}}
                    <strong><i class="fas fa-fingerprint mr-1"></i> NIS (Identificador)</strong>
                    <p class="text-muted">{{ $alternativaep->NIS }}</p>
                    <hr>

                    {{-- Campo Nombre --}}
                    <strong><i class="fas fa-list-alt mr-1"></i> Nombre de la Alternativa</strong>
                    <p class="text-muted">{{ $alternativaep->Nombre }}</p>
                </div>
                <div class="col-md-6">
                    {{-- Campo Descripcion --}}
                    <strong><i class="fas fa-align-left mr-1"></i> Descripción Detallada</strong>
                    <p class="text-muted">
                        {{ $alternativaep->Descripcion ?? 'No se ha proporcionado una descripción.' }}
                    </p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {{-- Botón Volver --}}
            <a href="{{ route('alternativaep.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver a la lista
            </a>
            {{-- Botón Editar --}}
            <a href="{{ route('alternativaep.edit', $alternativaep->NIS) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar esta alternativa
            </a>
        </div>
    </div>
@stop
