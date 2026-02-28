@extends('adminlte::page')

@section('title', 'Detalle del Rol')

@section('content_header')
    <h1>Detalle del Rol Administrativo</h1>
@stop

@section('content')
    <div class="card card-navy card-outline">
        <div class="card-header">
            <h3 class="card-title">Información General</h3>
            <div class="card-tools">
                <a href="{{ route('rolesadministrativos.index') }}" class="btn btn-default btn-sm">
                    <i class="fas fa-list"></i> Volver al listado
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center border-right">
                    {{-- Icono representativo --}}
                    <div class="py-3">
                        <i class="fas fa-user-shield fa-5x text-navy"></i>
                    </div>
                    <h4 class="text-muted">ID de Registro: {{ $rolesadministrativo->NIS }}</h4>
                </div>

                <div class="col-md-8 pl-4">
                    <div class="mb-4">
                        <label class="text-navy"><i class="fas fa-info-circle"></i> Descripción del Rol:</label>
                        <p class="display-5 font-weight-bold" style="font-size: 1.5rem;">
                            {{ $rolesadministrativo->Descripcion }}
                        </p>
                    </div>

                    <div class="mb-2">
                        <label class="text-navy"><i class="fas fa-key"></i> NIS (Identificador Único):</label>
                        <p class="text-muted">
                            {{ $rolesadministrativo->NIS }}
                            <span class="badge badge-success ml-2">Asignado Automáticamente</span>
                        </p>
                    </div>

                    <hr>
                    <small class="text-muted italic">
                        * Este rol puede ser asignado a personal administrativo del sistema.
                    </small>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light text-right">
            <a href="{{ route('rolesadministrativos.edit', $rolesadministrativo->NIS) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar este Rol
            </a>


        </div>
    </div>
@stop
