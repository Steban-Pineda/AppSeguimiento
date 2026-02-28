@extends('adminlte::page')

@section('title', isset($ente) ? 'Editar Ente' : 'Registrar Ente')

@section('content')
    <div class="card card-outline {{ isset($ente) ? 'card-warning' : 'card-success' }}">
        <div class="card-header">
            <h3>{{ isset($ente) ? 'Modificar Ente Conformador' : 'Registrar Ente Conformador' }}</h3>
        </div>

        <div class="card-body">
            <form method="POST"
                  action="{{ isset($ente) ? route('enteconformador.update', $ente->NIS) : route('enteconformador.store') }}"
                  enctype="multipart/form-data">

                @csrf
                @if(isset($ente))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo documento (ID)</label>
                            <input type="number" name="tdoc" class="form-control"
                                   value="{{ old('tdoc', $ente->tdoc ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Número documento</label>
                            <input type="number" name="Numdoc" class="form-control"
                                   value="{{ old('Numdoc', $ente->Numdoc ?? '') }}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Razón Social</label>
                    <input type="text" name="RazonSocial" class="form-control"
                           value="{{ old('RazonSocial', $ente->RazonSocial ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" name="Direccion" class="form-control"
                           value="{{ old('Direccion', $ente->Direccion ?? '') }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="number" name="Telefono" class="form-control"
                                   value="{{ old('Telefono', $ente->Telefono ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Correo Institucional</label>
                            <input type="email" name="CorreoInstitucional" class="form-control"
                                   value="{{ old('CorreoInstitucional', $ente->CorreoInstitucional ?? '') }}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="anexo_camara">Anexo Cámara de Comercio (PDF)</label>
                    <div class="input-group">
                        <input type="file" name="anexo_camara" id="anexo_camara" class="form-control" accept="application/pdf">
                    </div>

                    @if(isset($ente) && $ente->anexo_camara)
                        <div class="mt-2">
                            <span class="badge badge-info">
                                <i class="fas fa-file-pdf"></i> Archivo actual:
                                <a href="{{ asset('uploads/clientes/camara/' . $ente->anexo_camara) }}" target="_blank" class="text-white text-decoration-underline">
                                    {{ $ente->anexo_camara }}
                                </a>
                            </span>
                            <small class="d-block text-muted mt-1">Sube un archivo nuevo solo si deseas reemplazar el actual.</small>
                        </div>
                    @else
                        <small class="text-muted">Seleccione el archivo PDF de la empresa (Máx. 3MB).</small>
                    @endif
                </div>

                <div class="mt-4 text-right">
                    <button type="submit" class="btn {{ isset($ente) ? 'btn-warning' : 'btn-success' }}">
                        <i class="fas fa-save"></i> {{ isset($ente) ? 'Actualizar' : 'Guardar' }}
                    </button>
                    <a href="{{ route('enteconformador.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>

        {{-- Manejo de Errores --}}
        @if ($errors->any())
            <div class="card-footer">
                <div class="alert alert-danger mb-0">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
@stop
