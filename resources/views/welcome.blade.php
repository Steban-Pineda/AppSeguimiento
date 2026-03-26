@extends('adminlte::page')

@section('title', 'Inicio - SGDEP')
@section('sidebar')
@stop
@push('css')
    <style>
        .main-sidebar       { display: none !important; }
        .content-wrapper    { margin-left: 0 !important; }
        .main-footer        { margin-left: 0 !important; }
        /* Oculta el botón hamburguesa del sidebar */
        .nav-sidebar-toggle,
        [data-widget="pushmenu"] { display: none !important; }
    </style>
@endpush
@section('content_header')
    <h1 style="font-weight:800; color:#00324D;">
        <i class="fas fa-home mr-2" style="color:#39A900;"></i>
        Panel Principal
    </h1>
@stop

@section('content')
    <style>
        :root { --sena-green: #39A900; --sena-blue: #00324D; }

        .hero-banner {
            background: linear-gradient(135deg, var(--sena-blue) 0%, #005684 100%);
            border-radius: 20px;
            padding: 40px;
            color: white;
            margin-bottom: 35px;
            border-bottom: 5px solid var(--sena-green);
            box-shadow: 0 8px 25px rgba(0,50,77,0.25);
            position: relative;
            overflow: hidden;
        }

        .hero-banner::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            bottom: -100px; right: -80px;
        }

        .hero-banner img {
            width: 70px;
            filter: brightness(0) invert(1);
            margin-bottom: 15px;
        }

        .hero-banner h2 { font-weight: 800; font-size: 1.8rem; margin: 0; }
        .hero-banner p  { opacity: 0.75; margin: 6px 0 0; font-size: 0.95rem; }

        .section-title {
            font-weight: 700;
            color: var(--sena-blue);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            font-size: 1.1rem;
        }
        .section-title i { margin-right: 10px; color: var(--sena-green); }

        .card-module {
            border: none;
            border-radius: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            height: 100%;
            border-bottom: 4px solid transparent;
            background: white;
        }

        .card-module:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.12);
            border-bottom: 4px solid var(--sena-green);
        }

        .icon-circle {
            width: 58px; height: 58px;
            background: linear-gradient(135deg, #e8f5e9, #d0f0c0);
            color: var(--sena-green);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin: 0 auto 14px;
        }

        .icon-circle-sm {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #e8f5e9, #d0f0c0);
            color: var(--sena-green);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .btn-access {
            background: linear-gradient(135deg, var(--sena-blue), #005684);
            color: white;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
            border: none;
            padding: 8px;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .btn-access:hover {
            background: linear-gradient(135deg, var(--sena-green), #2d8500);
            color: white;
            transform: translateY(-1px);
        }

        .config-link {
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--sena-green);
            transition: color 0.2s;
        }
        .config-link:hover { color: var(--sena-blue); }

        .greeting-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(57,169,0,0.15);
            color: #39A900;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 4px 14px;
            border-radius: 20px;
            margin-bottom: 12px;
        }
    </style>

    {{-- Hero Banner --}}
    <div class="hero-banner">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="greeting-badge">
                    <i class="fas fa-circle" style="font-size:0.5rem;"></i>
                    SISTEMA ACTIVO
                </div>
                <h2>Bienvenido, {{ Auth::user()->name }}</h2>
                <p>Sistema de Gestión Documental · Etapa Productiva · SENA</p>
            </div>
            <div class="col-md-4 text-right d-none d-md-block">
                <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/SENA_logo.svg" alt="SENA">
            </div>
        </div>
    </div>

    {{-- Módulos: solo para Admin e Instructor --}}
    @if(Auth::user()->role !== 3)

        <h3 class="section-title">
            <i class="fas fa-layer-group"></i> Módulos Operativos
        </h3>
        <div class="row g-3 mb-5">
            @php
                $operativos = [
                    ['route' => 'Aprendices.index',           'title' => 'Aprendices',       'icon' => 'fa-user-graduate',      'desc' => 'Gestión y notificaciones'],
                    ['route' => 'Instructor.index',           'title' => 'Instructores',      'icon' => 'fa-chalkboard-teacher', 'desc' => 'Perfiles y asignaciones'],
                    ['route' => 'Fichadecaracterizacion.index','title' => 'Fichas',            'icon' => 'fa-id-card',            'desc' => 'Grupos y caracterización'],
                    ['route' => 'programadeformacion.index',  'title' => 'Programas',         'icon' => 'fa-book',               'desc' => 'Oferta educativa'],
                    ['route' => 'enteconformador.index',      'title' => 'Entes Coformadores','icon' => 'fa-building',           'desc' => 'Empresas vinculadas'],
                ];
            @endphp

            @foreach($operativos as $mod)
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="card card-module p-3 text-center">
                        <div class="icon-circle">
                            <i class="fas {{ $mod['icon'] }}"></i>
                        </div>
                        <h6 class="fw-bold mb-1" style="font-size:0.9rem; color:#00324D;">{{ $mod['title'] }}</h6>
                        <p class="text-muted mb-3" style="font-size:0.75rem;">{{ $mod['desc'] }}</p>
                        <a href="{{ route($mod['route']) }}" class="btn btn-access btn-sm">
                            <i class="fas fa-arrow-right mr-1"></i> Abrir
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <h3 class="section-title">
            <i class="fas fa-cogs"></i> Configuración del Sistema
        </h3>
        <div class="row g-3 mb-5">
            @php
                $config = [
                    ['route' => 'Regional.index',           'title' => 'Regionales',       'icon' => 'fa-map-marker-alt'],
                    ['route' => 'Centrodeformacion.index',  'title' => 'Centros',          'icon' => 'fa-school'],
                    ['route' => 'tiposeps.index',           'title' => 'EPS',              'icon' => 'fa-notes-medical'],
                    ['route' => 'rolesadministrativos.index','title' => 'Roles Admin',     'icon' => 'fa-user-tag'],
                    ['route' => 'tiposdocumento.index',     'title' => 'Documentos',       'icon' => 'fa-address-card'],
                    ['route' => 'alternativaep.index',      'title' => 'Alt. Etapa Prod.', 'icon' => 'fa-random'],
                    ['route' => 'Subalternativaep.index',   'title' => 'Sub-Alternativas', 'icon' => 'fa-code-branch'],
                ];
            @endphp

            @foreach($config as $item)
                <div class="col-md-3 col-sm-6">
                    <div class="card card-module p-3 d-flex flex-row align-items-center">
                        <div class="icon-circle-sm mr-3">
                            <i class="fas {{ $item['icon'] }}"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold" style="font-size:0.88rem; color:#00324D;">{{ $item['title'] }}</h6>
                            <a href="{{ route($item['route']) }}" class="config-link">
                                Configurar <i class="fas fa-arrow-right ml-1" style="font-size:0.7rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        {{-- Vista para el Aprendiz --}}
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-module p-4 text-center">
                    <div class="icon-circle mx-auto">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h5 class="fw-bold" style="color:#00324D;">Tu Perfil</h5>
                    <p class="text-muted small mb-4">Consulta y actualiza tu información personal registrada en el sistema.</p>
                    <a href="{{ route('mi.perfil') }}" class="btn btn-access">
                        <i class="fas fa-eye mr-2"></i> Ver Mi Perfil
                    </a>
                </div>
            </div>
        </div>
    @endif

@stop
