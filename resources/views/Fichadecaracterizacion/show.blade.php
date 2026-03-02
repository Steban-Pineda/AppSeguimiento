@extends('adminlte::page')

@section('title', 'Detalle de la Ficha')

@section('content_header')
    <h1>Ficha: {{ $fichadecaracterizacion->Codigo }}</h1>
@stop

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Información Completa de la Ficha</h3>
            {{-- Badge opcional para el estado de la ficha --}}
            <div class="card-tools">
                <span class="badge badge-primary">ID: {{ $fichadecaracterizacion->NIS }}</span>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                {{-- Bloque 1: Identificación y Cupos --}}
                <div class="col-md-4">
                    <h5 class="text-primary"><i class="fas fa-info-circle"></i> Datos Básicos</h5>
                    <hr>
                    <strong>NIS:</strong> <span class="text-muted">{{ $fichadecaracterizacion->NIS }}</span><br>
                    <strong>Código de Ficha:</strong> <span class="text-muted">{{ $fichadecaracterizacion->Codigo }}</span><br>
                    <strong>Nombre/Grupo:</strong> <span class="text-muted">{{ $fichadecaracterizacion->Denominacion }}</span><br>
                    <strong>Cupos Disponibles:</strong> <span class="badge badge-success">{{ $fichadecaracterizacion->Cupo }}</span>
                </div>

                {{-- Bloque 2: Relaciones (Llaves Foráneas) --}}
                <div class="col-md-4">
                    <h5 class="text-primary"><i class="fas fa-link"></i> Vinculación</h5>
                    <hr>
                    <strong>Programa de Formación:</strong><br>
                    <p class="text-muted">{{ $fichadecaracterizacion->programa->Denominacion ?? 'No asignado' }}</p>

                    <strong>Centro de Formación:</strong><br>
                    <p class="text-muted">{{ $fichadecaracterizacion->centro->Denominacion ?? 'No asignado' }}</p>
                </div>

                {{-- Bloque 3: Fechas y Otros --}}
                <div class="col-md-4">
                    <h5 class="text-primary"><i class="fas fa-calendar-alt"></i> Tiempos y Notas</h5>
                    <hr>
                    <strong>Fecha Inicio:</strong> <span class="text-muted">{{ $fichadecaracterizacion->fechaInicio }}</span><br>
                    <strong>Fecha Fin:</strong> <span class="text-muted">{{ $fichadecaracterizacion->fechaFin }}</span><br>
                    <br>
                    <strong>Observaciones:</strong>
                    <p class="text-sm text-justify">{{ $fichadecaracterizacion->Observaciones ?? 'Sin observaciones' }}</p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('Fichadecaracterizacion.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>

            {{-- AJUSTE AQUÍ: Usamos el array asociativo para evitar el error de parámetro faltante --}}
            <a href="{{ route('Fichadecaracterizacion.edit', ['Fichadecaracterizacion' => $fichadecaracterizacion->NIS]) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar Ficha
            </a>
        </div>
    </div>
@stop
