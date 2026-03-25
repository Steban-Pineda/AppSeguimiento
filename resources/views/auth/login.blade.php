@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', 'Bienvenido al Sistema')

@section('auth_body')
    <style>

        .login-page {
            background: linear-gradient(135deg, #00324D 0%, #005684 100%) !important;
        }

        /* Tarjeta redondeada y elegante */
        .login-box .card {
            border-radius: 20px !important;
            border-top: 6px solid #39A900 !important; /* El verde SENA arriba */
            box-shadow: 0 15px 35px rgba(0,0,0,0.3) !important;
        }

        /* Ajustes de los inputs */
        .input-group-text {
            border-radius: 0 10px 10px 0 !important;
            color: #00324D !important;
        }

        .form-control {
            border-radius: 10px 0 0 10px !important;
            height: 45px;
        }

        /* Botón Ingresar */
        .btn-primary {
            background-color: #39A900 !important;
            border: none !important;
            border-radius: 10px !important;
            height: 45px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2d8500 !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(57, 169, 0, 0.4);
        }

        .login-box-msg {
            color: #00324D;
            font-weight: 600;
        }
    </style>

    <form action="{{ route('login') }}" method="post">
        @csrf

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="Correo electrónico" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Contraseña">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Login button --}}
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-block btn-flat btn-primary">
                    <span class="fas fa-sign-in-alt"></span>
                    INGRESAR
                </button>
            </div>
        </div>
    </form>
@stop

@section('auth_footer')
    <p class="my-0 text-center">
        <a href="{{ route('password.request') }}" style="color: #00324D; font-size: 0.9rem;">
            ¿Olvidaste tu contraseña?
        </a>
    </p>
@stop
