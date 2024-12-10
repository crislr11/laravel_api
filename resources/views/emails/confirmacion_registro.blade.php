<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Registro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Confirmación de Registro</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Hola, {{ $nombre }}</h5>
                        <p class="card-text">Gracias por registrarte. Por favor, confirma tu cuenta haciendo clic en el siguiente enlace:</p>
                        <a href="{{ url(path: '/confirmar-cuenta/'.$user->remember_token) }}" class="btn btn-primary">Confirmar Cuenta</a>
                        <div class="card-footer text-muted" style="background-color: #f8f9fa;">
                            © 2024 Event App - All rights reserved
                        </div>
                    </div>
                    <!-- <div class="card-footer text-muted">
                        © 2024 Event App - Todos los derechos reservados
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>