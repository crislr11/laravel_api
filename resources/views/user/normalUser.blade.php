@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center"></div>
    <div class="dashboard">
        @if (Auth::check() && Auth::user()->rol === 'u')
            <div class="dashboard__card">
                <div class="dashboard__body">
                    <h1 class="dashboard__title">{{$title}}</h1>

                    @if ($events->isEmpty())
                        <p>No se encuentra ningún evento.</p>
                    @else
                        <div class="row">
                            @foreach ($events as $event)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-content-wrapper">
                                            <img src="{{ asset('storage/' . $event->image_url) }}" class="card-img-top"
                                                alt="Imagen del evento" />
                                            <div class="card-body">
                                                <h5 class="card-title">{{ Str::limit($event->title, 10) }}</h5>
                                                <p><strong>Categoría:</strong> {{ $event->category->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-container">
                                        <form action="{{ route('event.toggle-registration', $event->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn 
                                                                            @if($event->attendees->contains(Auth::user()->id)) 
                                                                                btn-danger
                                                                            @else 
                                                                                btn-success
                                                                            @endif">
                                                @if($event->attendees->contains(Auth::user()->id))
                                                    Anular
                                                @else
                                                    Registrarse
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if ($title === 'Eventos registrados')
                        <a href="{{ route('events.registered-events.pdf') }}" class="btn btn-primary">Generar PDF</a>
                    @endif
                    @if ($title === 'Eventos registrados')
                        <form action="{{ route('events.sendPdf') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-info">Enviar PDF por correo</button>
                        </form>
                    @endif
                </div>
            </div>
        @else
            <h1>Bienvenido a tu panel de usuario</h1>
            <p>Esta es tu pantalla principal. Aquí puedes ver tus eventos y configuraciones.</p>
        @endif
    </div>
</div>
@endsection