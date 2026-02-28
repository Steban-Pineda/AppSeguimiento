@extends('adminlte::page')

@section('title', 'Detalle Subalternativa')

@section('content_header')
    <h1>Detalle de la Subalternativa EP</h1>
@stop

@section('content')
    <div class="card card-outline card-info shadow">
        <div class="card-header">
            <h3 class="card-title">Información del Registro</h3>
            <div class="card-tools">
                <a href="{{ route('Subalternativaep.index') }}" class="btn btn-default btn-sm">
                    <i class="fas fa-arrow-left"></i> Volver al listado
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                {{-- Columna del Icono --}}
                <div class="col-md-3 text-center border-right">
                    <div class="py-4">
                        <i class="fas fa-layer-group fa-5x text-info"></i>
                    </div>
                    <div class="badge badge-info px-3 py-2">NIS: {{ $sub->NIS }}</div>
                </div>

                {{-- Columna de Información --}}
                <div class="col-md-9 pl-4">
                    <div class="mb-4">
                        <h5 class="text-muted font-weight-bold">Nombre de la Subalternativa</h5>
                        <p class="h4 text-navy">{{ $sub->Nombre }}</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-muted font-weight-bold">Descripción Completa</h5>
                        <div class="p-3 bg-light border rounded">
                            {{ $sub->Descripcion }}
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <small class="text-muted">Estado del Registro:</small>
                            <p><span class="badge badge-success">Activo</span></p>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted">Tipo de Identificador:</small>
                            <p>Autoincremental (NIS)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer text-right">
            {{-- Botón Editar --}}
            <a href="{{ route('Subalternativaep.edit', $sub->NIS) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar Información
            </a>

            {{-- Botón Eliminar --}}

        </div>
    </div>
@stop
