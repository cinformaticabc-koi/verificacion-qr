<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gafetes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .card-stat {
            border-left: 5px solid;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .card-stat:hover {
            transform: translateY(-5px);
        }
        .card-stat.activos {
            border-left-color: #28a745;
        }
        .card-stat.bloqueados {
            border-left-color: #dc3545;
        }
        .card-stat.proximos {
            border-left-color: #ffc107;
        }
        .card-stat.total {
            border-left-color: #667eea;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .stat-icon {
            font-size: 2rem;
            opacity: 0.3;
        }
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
        .badge-activo {
            background-color: #28a745;
        }
        .badge-bloqueado {
            background-color: #dc3545;
        }
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-id-card"></i> Gafetes - Sistema de Verificación</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/dashboard"><i class="fas fa-chart-bar"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/generar"><i class="fas fa-plus-circle"></i> Generar Gafete</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <!-- Alertas -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Estadísticas -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card card-stat total">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total de Gafetes</p>
                            <p class="stat-number">{{ $totalGafetes }}</p>
                        </div>
                        <i class="fas fa-id-card stat-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card card-stat activos">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Activos</p>
                            <p class="stat-number text-success">{{ $gafetesActivos }}</p>
                        </div>
                        <i class="fas fa-check-circle stat-icon" style="color: #28a745;"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card card-stat bloqueados">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Bloqueados</p>
                            <p class="stat-number text-danger">{{ $gafetesBloqueados }}</p>
                        </div>
                        <i class="fas fa-ban stat-icon" style="color: #dc3545;"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card card-stat proximos">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Próx. a Expirar</p>
                            <p class="stat-number text-warning">{{ $gafetesProxAExpirar }}</p>
                        </div>
                        <i class="fas fa-hourglass-end stat-icon" style="color: #ffc107;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Gafetes -->
        <div class="card shadow">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fas fa-list"></i> Listado de Gafetes</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Cédula</th>
                                <th>Municipio</th>
                                <th>Estado</th>
                                <th>Válido hasta</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($gafetes as $gafete)
                                <tr>
                                    <td><small class="text-muted">#{{ $gafete->id }}</small></td>
                                    <td><strong>{{ $gafete->nombre }} {{ $gafete->apellido }}</strong></td>
                                    <td>{{ substr($gafete->cedula, 0, 3) }}****{{ substr($gafete->cedula, -3) }}</td>
                                    <td>{{ $gafete->municipio }}</td>
                                    <td>
                                        @if($gafete->estado === 'activo')
                                            <span class="badge badge-activo">Activo</span>
                                        @else
                                            <span class="badge badge-bloqueado">Bloqueado</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($gafete->fecha_expiracion < now()->addDays(7))
                                            <small class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $gafete->fecha_expiracion->format('d/m/Y') }}</small>
                                        @else
                                            <small>{{ $gafete->fecha_expiracion->format('d/m/Y') }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Botón Verificar -->
                                        <a href="/validar/{{ $gafete->token }}" class="btn btn-sm btn-info btn-action" target="_blank" title="Verificar">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Botón Descargar QR -->
                                        <a href="/descargar-qr/{{ $gafete->id }}" class="btn btn-sm btn-success btn-action" title="Descargar QR">
                                            <i class="fas fa-download"></i>
                                        </a>

                                        <!-- Botón Bloquear/Activar -->
                                        <form action="/gafetes/{{ $gafete->id }}/bloquear" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning btn-action" title="Bloquear/Activar">
                                                <i class="fas fa-lock"></i>
                                            </button>
                                        </form>

                                        <!-- Botón Eliminar -->
                                        <form action="/gafetes/{{ $gafete->id }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Está seguro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-action" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox"></i> No hay gafetes generados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-3">
                    {{ $gafetes->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>