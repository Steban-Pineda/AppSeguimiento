<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENA - Seguimiento Etapa Productiva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --sena-green: #39A900; --sena-blue: #00324D; }
        body { background-color: #f0f2f5; font-family: 'Public Sans', sans-serif; }
        .hero { background: linear-gradient(135deg, var(--sena-blue) 0%, #005684 100%); color: white; padding: 50px 0; margin-bottom: 40px; border-bottom: 5px solid var(--sena-green); }
        .card-module { border: none; border-radius: 15px; transition: all 0.3s ease; box-shadow: 0 4px 6px rgba(0,0,0,0.05); height: 100%; border-bottom: 4px solid transparent; }
        .card-module:hover { transform: translateY(-7px); box-shadow: 0 12px 20px rgba(0,0,0,0.1); border-bottom: 4px solid var(--sena-green); }
        .icon-circle { width: 60px; height: 60px; background-color: #e8f5e9; color: var(--sena-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 15px; }
        .btn-access { background-color: var(--sena-blue); color: white; border-radius: 10px; font-weight: 600; width: 100%; }
        .btn-access:hover { background-color: var(--sena-green); color: white; }
        .section-title { font-weight: 700; color: var(--sena-blue); margin-bottom: 25px; display: flex; align-items: center; }
        .section-title i { margin-right: 10px; color: var(--sena-green); }
    </style>
</head>
<body>

<div class="hero text-center shadow-sm">
    <div class="container">
        <img src="https://upload.wikimedia.org/wikipedia/commons/8/83/SENA_logo.svg" alt="Logo SENA" style="width: 80px; filter: brightness(0) invert(1); margin-bottom: 20px;">
        <h1 class="fw-bold">Gestión de Seguimiento</h1>
        <p class="lead opacity-75">Panel de administración Etapa Productiva</p>
    </div>
</div>

<div class="container pb-5">

    <h3 class="section-title"><i class="fas fa-layer-group"></i> Módulos Operativos</h3>
    <div class="row g-4 mb-5">
        @php
            $operativos = [
                ['route' => 'Aprendices.index', 'title' => 'Aprendices', 'icon' => 'fa-user-graduate', 'desc' => 'Gestión y notificaciones'],
                ['route' => 'Instructor.index', 'title' => 'Instructores', 'icon' => 'fa-chalkboard-teacher', 'desc' => 'Perfiles y asignaciones'],
                ['route' => 'Fichadecaracterizacion.index', 'title' => 'Fichas', 'icon' => 'fa-id-card', 'desc' => 'Grupos y caracterización'],
                ['route' => 'programadeformacion.index', 'title' => 'Programas', 'icon' => 'fa-book', 'desc' => 'Oferta educativa'],
                ['route' => 'enteconformador.index', 'title' => 'Entes Coformadores', 'icon' => 'fa-building-workplace', 'desc' => 'Empresas vinculadas'],
            ];
        @endphp

        @foreach($operativos as $mod)
            <div class="col-md-4 col-lg-2.4" style="flex: 0 0 auto; width: 20%;">
                <div class="card card-module p-3 text-center">
                    <div class="icon-circle"><i class="fas {{ $mod['icon'] }}"></i></div>
                    <h6 class="fw-bold">{{ $mod['title'] }}</h6>
                    <p class="text-muted small mb-3">{{ $mod['desc'] }}</p>
                    <a href="{{ route($mod['route']) }}" class="btn btn-access btn-sm">Abrir</a>
                </div>
            </div>
        @endforeach
    </div>

    <h3 class="section-title"><i class="fas fa-cogs"></i> Configuración del Sistema</h3>
    <div class="row g-4">
        @php
            $config = [
                ['route' => 'Regional.index', 'title' => 'Regionales', 'icon' => 'fa-map-location-dot'],
                ['route' => 'Centrodeformacion.index', 'title' => 'Centros', 'icon' => 'fa-school'],
                ['route' => 'tiposeps.index', 'title' => 'EPS', 'icon' => 'fa-notes-medical'],
                ['route' => 'rolesadministrativos.index', 'title' => 'Roles Admin', 'icon' => 'fa-user-tag'],
                ['route' => 'tiposdocumento.index', 'title' => 'Documentos', 'icon' => 'fa-address-card'],
                ['route' => 'alternativaep.index', 'title' => 'Alt. Etapa Prod.', 'icon' => 'fa-shuffle'],
                ['route' => 'Subalternativaep.index', 'title' => 'Sub-Alternativas', 'icon' => 'fa-code-branch'],
            ];
        @endphp

        @foreach($config as $item)
            <div class="col-md-3">
                <div class="card card-module p-3 d-flex flex-row align-items-center">
                    <div class="icon-circle m-0 me-3" style="width: 45px; height: 45px; font-size: 1.1rem;">
                        <i class="fas {{ $item['icon'] }}"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1 fw-bold" style="font-size: 0.9rem;">{{ $item['title'] }}</h6>
                        <a href="{{ route($item['route']) }}" class="text-decoration-none small fw-bold" style="color: var(--sena-green);">Configurar <i class="fas fa-arrow-right ms-1" style="font-size: 0.7rem;"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

<footer class="bg-white text-center py-4 border-top mt-5">
    <p class="text-muted small mb-0">© {{ date('2026') }} Sistema de Gestión de Etapa Productiva - SENA</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
