@extends('layouts.app')

@section('content')
<div class="event-page">
    <div class="event-form">
        <h3 class="event-form__title">{{ __('Crear Evento') }}</h3>
        <form method="POST" action="{{ route('organizer.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="event-form__container">
                <!-- Primera Columna -->
                <div class="event-form__column">
                    <div class="event-form__field">
                        <label for="title">{{ __('Título del Evento') }}</label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"
                            required autofocus>
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="event-form__field">
                        <label for="description">{{ __('Descripción') }}</label>
                        <textarea id="description" class="form-control" name="description"
                            required>{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="event-form__field">
                        <label for="start_time">Fecha de Inicio</label>
                        <input type="datetime-local" id="start_time" name="start_time" class="form-control"
                            value="{{ old('start_time') }}" required>
                        @error('start_time')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="event-form__field">
                        <label for="location">Ubicación</label>
                        <input type="text" id="location" name="location" class="form-control"
                            value="{{ old('location') }}" required>
                        @error('location')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="event-form__field">
                        <label for="price">Precio</label>
                        <input type="number" step="0.01" id="price" name="price" class="form-control"
                            value="{{ old('price') }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Segunda Columna -->
                <div class="event-form__column">

                    <div class="event-form__field">
                        <label for="max_attendees">Máximo de Asistentes</label>
                        <input type="number" id="max_attendees" name="max_attendees" class="form-control"
                            value="{{ old('max_attendees') }}" required>
                        @error('max_attendees')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="event-form__field">
                        <label for="latitude">Latitud</label>
                        <input type="text" name="latitude" id="latitude" class="form-control"
                            value="{{ old('latitude') }}" required>
                    </div>

                    <div class="event-form__field">
                        <label for="longitude">Longitud</label>
                        <input type="text" name="longitude" id="longitude" class="form-control"
                            value="{{ old('longitude') }}" required>
                    </div>

                    <div class="event-form__field">
                        <label for="end_time">Fecha de Fin</label>
                        <input type="datetime-local" id="end_time" name="end_time" class="form-control"
                            value="{{ old('end_time') }}" required>
                        @error('end_time')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="event-form__field">
                        <label for="category_id">Categoría</label>
                        <select id="category_id" name="category_id" class="form-control" required>
                            <option value="">Seleccione una categoría</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo de Imagen dentro de la Segunda Columna -->
                    <div class="event-form__field">
                        <label for="image_url">{{ __('Imagen del Evento') }}</label>
                        <input id="image_url" type="file" name="image_url" class="form-control" accept="image/*">
                        @error('image_url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="event-form__footer">
                <button type="submit" class="event-form__button">{{ __('Crear Evento') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection