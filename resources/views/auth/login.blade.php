@extends('layouts.app')

@section('content')
<div class="login-page">
    <div class="login-page__left-panel">
        <div class="login-page__logo">
            <img src="{{ Vite::asset('resources/img/eventify_logo.png') }}" alt="imagen logo">
        </div>
        <h1 class="login-page__welcome-title">Bienvenido a Eventify</h1>
        <p class="login-page__description">
            Eventify es tu aplicación para buscar y guardar eventos que no querrás perderte. ¡Explora lo mejor de la diversión y la cultura!
        </p>
    </div>
    <div class="login-page__right-panel">
        <h2 class="login-page__login-title">Iniciar Sesión</h2>
        <p class="login-page__login-subtitle">
            ¡Bienvenido! Inicia sesión para obtener acceso a eventos exclusivos y guardarlos para después.
        </p>

        @if (session('status'))
            <div class="alert alert-success" role="alert" id="success-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Recuérdame') }}
                    </label>
                </div>
            </div>

            <div class="mb-0">
                <button type="submit" class="btn btn-primary">
                    {{ __('Iniciar Sesión') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
            </div>
        </form>

        <div class="login-form__footer mt-4">
            <p>¿Eres nuevo? <a href="{{ route('register') }}" class="login-form__link">Regístrate</a></p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.transition = 'opacity 1s';
                successMessage.style.opacity = '0';
                setTimeout(function() {
                    successMessage.remove();
                }, 1000);
            }, 5000); // El mensaje desaparecerá después de 5 segundos
        }
    });
</script>
@endsection
