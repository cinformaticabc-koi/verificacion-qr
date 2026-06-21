<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación - Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        .card {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border-left: 5px solid #dc3545;
        }
    </style>
</head>
<body>
    <div class="card" style="max-width: 500px;">
        <div class="card-body text-center">
            <h1 class="text-danger mb-4">❌</h1>
            <h2 class="text-danger mb-4">Verificación Fallida</h2>
            
            <div class="alert alert-danger">
                {{ $mensaje }}
            </div>
            
            <p class="text-muted">
                Si cree que esto es un error, contacte a las autoridades locales.
            </p>
        </div>
    </div>
</body>
</html>