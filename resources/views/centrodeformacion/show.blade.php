{{-- Extiende la plantilla base de AdminLTE --}}
@extends('adminlte::page')

{{-- Título dinámico con el nombre del centro para la pestaña del navegador --}}
@section('title', 'Detalle del Centro - ' . $centro->Denominacion)

@section('content_header')
    <h1>Detalle del Centro de Formación</h1>
@stop

@section('content')
    <div class="card card-info"> {{-- Color azul para indicar que es solo información/lectura --}}
        <div class="card-header">
            <h3 class="card-title">Información General</h3>
            <div class="card-tools">
                {{-- Botón para volver rápidamente al listado --}}
                <a href="{{ route('Centrodeformacion.index') }}" class="btn btn-tool">
                    <i class="fas fa-list"></i> Volver al listado
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                {{-- Columna Izquierda: Identificación --}}
                <div class="col-md-6">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>NIS (ID Interno)</b> <a class="float-right text-primary">{{ $centro->NIS }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Código de Centro</b> <a class="float-right text-primary">{{ $centro->Codigo }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Denominación</b> <p class="mt-2 text-muted">{{ $centro->Denominacion }}</p>
                        </li>
                    </ul>
                </div>

                {{-- Columna Derecha: Ubicación y Relación --}}
                <div class="col-md-6">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Dirección</b> <a class="float-right text-muted">{{ $centro->Direccion }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Regional Perteneciente</b>
                            {{-- Acceso a la relación cargada en el controlador --}}
                            <a class="float-right badge badge-info p-2">
                                {{ $centro->regional->Denominacion ?? 'No asignada' }}
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Código Regional</b>
                            <a class="float-right text-muted">{{ $centro->regional->Codigo ?? 'N/A' }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Fila inferior para textos largos --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info-circle"></i> Observaciones</h5>
                        <p>{{ $centro->Observaciones ?? 'Sin observaciones registradas.' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer con acciones rápidas --}}
        <div class="card-footer">
            <a href="{{ route('Centrodeformacion.edit', $centro->NIS) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar Datos
            </a>
            <a href="{{ route('Centrodeformacion.index') }}" class="btn btn-secondary">
                Regresar
            </a>
        </div>
    </div>
@stop
