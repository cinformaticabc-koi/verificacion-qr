<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Encuestador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        .card {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border-left: 5px solid #28a745;
        }
        .badge-valid {
            background: #28a745;
            padding: 10px 20px;
            border-radius: 50px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="card" style="max-width: 500px;">
        <div class="card-body text-center">
            <h1 class="text-success mb-4">✅</h1>
            <h2 class="text-success mb-4">Encuestador Verificado</h2>
            
            <hr>
            
            <div class="text-start">
                <p><strong>Nombre:</strong> {{ $gafete->nombre }} {{ $gafete->apellido }}</p>
                <p><strong>Cédula:</strong> {{ substr($gafete->cedula, 0, 3) }}****{{ substr($gafete->cedula, -3) }}</p>
                <p><strong>Teléfono:</strong> {{ $gafete->telefono }}</p>
                <p><strong>Supervisor:</strong> {{ $gafete->supervisor }}</p>
                <p><strong>Municipio:</strong> {{ $gafete->municipio }}</p>
                <p><strong>Válido hasta:</strong> <span class="badge bg-info">{{ $gafete->fecha_expiracion->format('d/m/Y') }}</span></p>
            </div>
            
            <hr>
            
            <div class="alert alert-info small">
                Este encuestador está autorizado para recopilar información en nombre del municipio.
                Si tiene dudas, contacte a las autoridades locales.
            </div>
        </div>
    </div>
</body>
</html>