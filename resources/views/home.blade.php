@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card home border-0"> 
                <div class="home__header card-header border-0">{{ __('Bienvenido a Eventify') }}</div>
                
                <div class="home__body card-body">
                    <p class="home__description">
                        {{ __('Eventify es tu plataforma ideal para descubrir y guardar eventos emocionantes que no querrás perderte.') }}
                    </p>

                    <p class="home__description">
                        {{ __('Nuestra aplicación te permite explorar una variedad de eventos culturales, sociales y recreativos que se llevan a cabo en tu área. Ya sea que busques conciertos, exposiciones de arte, talleres o festivales, Eventify tiene algo para ti.') }}
                    </p>

                    <p class="home__description">
                        {{ __('Te ofrecemos una experiencia personalizada donde podrás guardar tus eventos favoritos, recibir notificaciones y mucho más. Estamos comprometidos en brindarte la mejor experiencia para que no te pierdas de nada.') }}
                    </p>

                    <p class="home__call-to-action">
                        {{ __('¡Únete a nuestra comunidad hoy y comienza a explorar lo que tu ciudad tiene para ofrecer!') }}
                    </p>

                    <div class="home__buttons mt-4 row d-flex align-items-stretch">
                        <div class="col-md-6">
                            <a href="{{ route('login') }}" class="btn btn-primary w-100">
                                {{ __('Iniciar Sesión') }}
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('register') }}" class="btn btn-secondary w-100">
                                {{ __('Registrarse') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
