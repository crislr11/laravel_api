<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activación de Cuenta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4>Activación de Cuenta</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Hola, {{ $nombre }}</h5>
                        <p class="card-text">Tu cuenta ha sido activada por el administrador. Ya puedes iniciar sesión.</p>
                        <a href="{{ url('/login') }}" class="btn btn-primary">Iniciar Sesión</a>
                        <div class="card-footer text-muted" style="background-color: #f8f9fa;">
                            © 2024 Event App - All rights reserved
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>