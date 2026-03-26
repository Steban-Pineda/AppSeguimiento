@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header')
@stop

@section('auth_body')
    <style>
        /* ── Fondo ── */
        .login-page {
            background: linear-gradient(160deg, #00324D 0%, #005684 50%, #39A900 100%) !important;
            position: relative;
            overflow: hidden;
        }

        /* Círculos decorativos de fondo */
        .login-page::before {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: rgba(57,169,0,0.08);
            top: -100px; left: -100px;
        }
        .login-page::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            bottom: -80px; right: -80px;
        }

        /* ── Caja del login ── */
        .login-box {
            width: 400px !important;
        }

        .login-box .card {
            border: none !important;
            border-radius: 24px !important;
            box-shadow: 0 25px 60px rgba(0,0,0,0.35) !important;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        /* ── Header de la card con logo ── */
        .login-box .card::before {
            content: '';
            display: block;
            height: 8px;
            background: linear-gradient(90deg, #39A900, #005684);
        }

        .card-body {
            padding: 2rem 2.5rem !important;
        }

        /* ── Logo y título ── */
        .login-logo-area {
            text-align: center;
            padding: 1.8rem 0 1.2rem;
        }

        .login-logo-area .logo-icon {
            width: 72px; height: 72px;
            background: linear-gradient(135deg, #00324D, #005684);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            box-shadow: 0 8px 20px rgba(0,50,77,0.3);
        }

        .login-logo-area .logo-icon i {
            font-size: 2rem;
            color: #39A900;
        }

        .login-logo-area h4 {
            font-weight: 800;
            color: #00324D;
            letter-spacing: 1px;
            margin: 0;
            font-size: 1.3rem;
        }

        .login-logo-area p {
            color: #6c757d;
            font-size: 0.82rem;
            margin: 4px 0 0;
            letter-spacing: 0.5px;
        }

        /* ── Labels ── */
        .field-label {
            font-size: 0.78rem;
            font-weight: 700;
            color: #00324D;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 6px;
        }

        /* ── Inputs ── */
        .input-group {
            border-radius: 12px !important;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            margin-bottom: 1.2rem !important;
        }

        .input-group .form-control {
            border: 2px solid #e9ecef !important;
            border-right: none !important;
            border-radius: 12px 0 0 12px !important;
            height: 50px !important;
            font-size: 0.95rem;
            color: #00324D;
            transition: all 0.3s;
            padding-left: 16px;
        }

        .input-group .form-control:focus {
            border-color: #39A900 !important;
            box-shadow: none !important;
            background: #f8fff5 !important;
        }

        .input-group-text {
            background: #f8f9fa !important;
            border: 2px solid #e9ecef !important;
            border-left: none !important;
            border-radius: 0 12px 12px 0 !important;
            color: #39A900 !important;
            padding: 0 16px !important;
            transition: all 0.3s;
        }

        .form-control:focus ~ .input-group-append .input-group-text {
            border-color: #39A900 !important;
            background: #f8fff5 !important;
        }

        /* ── Botón ── */
        .btn-ingresar {
            background: linear-gradient(135deg, #39A900, #2d8500) !important;
            border: none !important;
            border-radius: 12px !important;
            height: 50px !important;
            font-weight: 700 !important;
            font-size: 0.95rem !important;
            letter-spacing: 1.5px !important;
            color: white !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 15px rgba(57,169,0,0.35) !important;
            margin-top: 0.5rem;
        }

        .btn-ingresar:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(57,169,0,0.45) !important;
            background: linear-gradient(135deg, #2d8500, #39A900) !important;
        }

        .btn-ingresar:active {
            transform: translateY(0) !important;
        }

        /* ── Divisor ── */
        .divider {
            display: flex;
            align-items: center;
            margin: 1.2rem 0;
            color: #adb5bd;
            font-size: 0.78rem;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e9ecef;
        }
        .divider span { padding: 0 12px; }

        /* ── Footer link ── */
        .forgot-link {
            color: #005684 !important;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }
        .forgot-link:hover { color: #39A900 !important; }

        /* ── Badge SENA ── */
        .sena-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(90deg, #00324D, #005684);
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 1rem;
        }
        .sena-badge span { color: #39A900; }
    </style>

    {{-- Logo y título --}}
    <div class="login-logo-area">
        <div class="logo-icon">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="sena-badge">
            <span>●</span> SENA · SGDEP
        </div>
        <h4>Bienvenido</h4>
        <p>Sistema de Gestión Documental · Etapa Productiva</p>
    </div>

    <form action="{{ route('login') }}" method="post">
        @csrf

        {{-- Email --}}
        <div class="field-label">Correo electrónico</div>
        <div class="input-group">
            <input type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="usuario@sena.edu.co"
                   autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Contraseña --}}
        <div class="field-label">Contraseña</div>
        <div class="input-group">
            <input type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="••••••••">
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="divider"><span>·</span></div>

        {{-- Botón --}}
        <button type="submit" class="btn btn-block btn-ingresar">
            <i class="fas fa-sign-in-alt mr-2"></i> INGRESAR AL SISTEMA
        </button>

    </form>
@stop

@section('auth_footer')
    <p class="my-0 text-center">
        <a href="{{ route('password.request') }}" class="forgot-link">
            <i class="fas fa-key mr-1"></i> ¿Olvidaste tu contraseña?
        </a>
    </p>
@stop
