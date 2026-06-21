<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Gafete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin-top: 30px;
        }
        .card {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        .qr-result {
            text-align: center;
            margin-top: 30px;
        }
        .qr-image {
            max-width: 400px;
            border: 3px solid #667eea;
            border-radius: 10px;
            padding: 20px;
            background: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-white mb-4">Generar Gafete con QR</h1>
        
        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            
            <!-- Mostrar QR generado -->
            @if(session('qrCode'))
                <div class="qr-result card p-4">
                    <h2 class="mb-4">QR Generado</h2>
                    
                    <img src="{{ session('qrCode') }}" alt="QR Code" class="qr-image">
                    
                    <div class="mt-4">
                       <p><strong>Nombre:</strong> {{ session('gafete')['nombre'] }} {{ session('gafete')['apellido'] }}</p>
<p><strong>URL:</strong> {{ session('url') }}</p>
                    </div>
                    
                    <div class="mt-3">
                        <a href="/descargar-qr/{{ session('gafete')['id'] }}" class="btn btn-primary btn-lg">
                            📥 Descargar QR
                        </a>
                        <a href="/generar" class="btn btn-secondary btn-lg">
                            ➕ Generar otro
                        </a>
                    </div>
                </div>
            @endif
        @endif
        
        <!-- Formulario -->
        <form action="/generar" method="POST" class="card p-4">
            @csrf
            
            <h3 class="mb-4">Datos del Encuestador</h3>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                           id="nombre" name="nombre" required value="{{ old('nombre') }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control @error('apellido') is-invalid @enderror" 
                           id="apellido" name="apellido" required value="{{ old('apellido') }}">
                    @error('apellido')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cedula" class="form-label">Cédula</label>
                    <input type="text" class="form-control @error('cedula') is-invalid @enderror" 
                           id="cedula" name="cedula" required value="{{ old('cedula') }}">
                    @error('cedula')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control @error('telefono') is-invalid @enderror" 
                           id="telefono" name="telefono" required value="{{ old('telefono') }}">
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="supervisor" class="form-label">Supervisor</label>
                    <input type="text" class="form-control @error('supervisor') is-invalid @enderror" 
                           id="supervisor" name="supervisor" required value="{{ old('supervisor') }}">
                    @error('supervisor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="municipio" class="form-label">Municipio</label>
                    <input type="text" class="form-control @error('municipio') is-invalid @enderror" 
                           id="municipio" name="municipio" required value="{{ old('municipio') }}">
                    @error('municipio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <button type="submit" class="btn btn-success btn-lg w-100">
                ✨ Generar Gafete con QR
            </button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>