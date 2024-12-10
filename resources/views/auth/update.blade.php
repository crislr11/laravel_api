@extends('layouts.app')

@section('content')
<div class="container">
    <div class="edit-user-container">
        <div class="edit-user-card">
            <div class="edit-user-card__header">
                <h1>{{ __('Editar Usuario') }}</h1>
            </div>

            <div class="edit-user-card__body">
                <!-- Mostrar el nombre actual del usuario -->
                <p><strong>Nombre actual:</strong> {{ $user->name }}</p>

                <form action="{{ route('profile.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Campo de Nombre -->
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>

                    <!-- Contenedor del botón -->
                    <div class="btn-container">
                        <!-- Botón de enviar -->
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
