@extends('adminlte::page')

@section('title', 'Perfil del Aprendiz')

@section('content_header')
    <h1>Perfil Detallado: {{ $aprendiz->Nombres }} {{ $aprendiz->Apellidos }}</h1>
@stop

@section('content')
    <div class="row">
        {{-- Columna Izquierda: Resumen y Contacto --}}
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        {{-- Genera un avatar automático con las iniciales --}}
                        <img class="profile-user-img img-fluid img-circle"
                             src="https://ui-avatars.com/api/?name={{ urlencode($aprendiz->Nombres . ' ' . $aprendiz->Apellidos) }}&background=0D6EFD&color=fff"
                             alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $aprendiz->Nombres }}</h3>
                    <p class="text-muted text-center">{{ $aprendiz->tipoDocumento->Denominacion ?? 'Documento' }} No. {{ $aprendiz->Numdoc }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Género</b>
                            <span class="float-right badge {{ $aprendiz->sexo == 1 ? 'badge-primary' : 'badge-danger' }}">
                                {{ $aprendiz->sexo == 1 ? 'Masculino' : 'Femenino' }}
                            </span>
                        </li>
                        <li class="list-group-item">
                            <b>Ficha NIS</b> <a class="float-right text-primary">{{ $aprendiz->tbl_fichadecaracterizacion_NIS }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Edad</b> <a class="float-right">{{ \Carbon\Carbon::parse($aprendiz->fechaNacimiento)->age }} años</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-address-book mr-1"></i> Información de Contacto</h3>
                </div>
                <div class="card-body">
                    <strong><i class="fas fa-phone mr-1"></i> Teléfono</strong>
                    <p class="text-muted">{{ $aprendiz->Telefono }}</p>
                    <hr>
                    <strong><i class="fas fa-envelope mr-1"></i> Correo Institucional</strong>
                    <p class="text-muted">{{ $aprendiz->CorreoInstitucional }}</p>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección</strong>
                    <p class="text-muted">{{ $aprendiz->Direccion }}</p>
                </div>
            </div>
        </div>

        {{-- Columna Derecha: Información Académica y Salud --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-2 bg-white">
                    <h3 class="card-title p-2">Datos Complementarios</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5 class="text-primary"><i class="fas fa-graduation-cap"></i> Ficha / Programa</h5>
                            <p class="text-dark"><strong>{{ $aprendiz->ficha->Denominacion ?? 'No asignada' }}</strong></p>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="text-primary"><i class="fas fa-hospital-user"></i> EPS Asignada</h5>
                            <p class="text-dark"><strong>{{ $aprendiz->eps->Denominacion ?? 'No registrada' }}</strong></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="text-primary"><i class="fas fa-calendar-alt"></i> Fecha de Nacimiento</h5>
                            <p class="text-muted">{{ \Carbon\Carbon::parse($aprendiz->fechaNacimiento)->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="text-primary"><i class="fas fa-at"></i> Correo Personal</h5>
                            <p class="text-muted">{{ $aprendiz->CorreoPersonal }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('Aprendices.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver a la lista
                    </a>
                    <a href="{{ route('Aprendices.edit', $aprendiz->NIS) }}" class="btn btn-warning float-right text-white">
                        <i class="fas fa-edit"></i> Editar Información
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
