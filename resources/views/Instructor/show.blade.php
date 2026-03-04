@extends('adminlte::page')

@section('title', 'Perfil del Instructor')

@section('content_header')
    <h1>Información del Instructor</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            {{-- Tarjeta de Perfil Rápido --}}
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        {{-- Icono representativo según el sexo --}}
                        <i class="fas fa-user-tie fa-7x text-muted mb-3"></i>
                    </div>
                    <h3 class="profile-username text-center">{{ $instructor->Nombres }}</h3>
                    <p class="text-muted text-center">{{ $instructor->Apellidos }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Rol</b>
                            <span class="float-right badge badge-primary">
                                {{ $instructor->rolAdministrativo->Denominacion ?? 'No asignado' }}
                            </span>
                        </li>
                        <li class="list-group-item">
                            <b>NIS</b> <a class="float-right">{{ $instructor->NIS }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Documento</b>
                            <a class="float-right">{{ $instructor->tipoDocumento->Denominacion ?? '' }} {{ $instructor->Numdoc }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos Detallados</h3>
                </div>
                <div class="card-body">
                    <strong><i class="fas fa-envelope mr-1"></i> Correos Electrónicos</strong>
                    <p class="text-muted">
                        Institucional: <span class="text-primary">{{ $instructor->CorreoInstitucional }}</span><br>
                        Personal: {{ $instructor->CorreoPersonal }}
                    </p>
                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Ubicación y Contacto</strong>
                    <p class="text-muted">
                        Dirección: {{ $instructor->Direccion }}<br>
                        Teléfono: {{ $instructor->Telefono }}
                    </p>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong><i class="fas fa-calendar-alt mr-1"></i> Fecha de Nacimiento</strong>
                            <p class="text-muted">{{ \Carbon\Carbon::parse($instructor->fechaNacimiento)->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong><i class="fas fa-hospital mr-1"></i> Seguridad Social (EPS)</strong>
                            <p class="text-muted">{{ $instructor->eps->Denominacion ?? 'No registrada' }}</p>
                        </div>
                    </div>
                    <hr>

                    <strong><i class="fas fa-venus-mars mr-1"></i> Sexo</strong>
                    <p class="text-muted">
                        {{ $instructor->sexo == 1 ? 'Masculino' : ($instructor->sexo == 2 ? 'Femenino' : 'No definido') }}
                    </p>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('Instructor.edit', $instructor->NIS) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar Perfil
                    </a>
                    <a href="{{ route('Instructor.index') }}" class="btn btn-secondary">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
