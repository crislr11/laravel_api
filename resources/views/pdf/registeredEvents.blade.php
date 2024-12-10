<!DOCTYPE html>
<html>
<head>
    <title>Eventos Registrados</title>
</head>
<body>
    <h1>{{ $user->name }}</h1>
    @foreach ($events as $event)
        <div>
            <img src="{{ public_path('storage/' . str_replace('\\', '/', $event->image_url)) }}" alt="Imagen del evento" style="width: 100px; height: 100px;">
            <p>{{ $event->title }}</p>
            <p>{{ $event->organizer->name }}</p>
            <p>{{ $event->start_time }}</p>
        </div>
    @endforeach
</body>
</html>