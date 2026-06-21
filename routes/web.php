<?php

use App\Http\Controllers\VerificacionController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Rutas públicas de verificación
Route::get('/validar/{token}', [VerificacionController::class, 'verificar']);

// Rutas de administración
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::post('/gafetes/{id}/bloquear', [DashboardController::class, 'bloquear']);
Route::delete('/gafetes/{id}', [DashboardController::class, 'eliminar']);

// Rutas de generación
Route::get('/generar', [VerificacionController::class, 'generar']);
Route::post('/generar', [VerificacionController::class, 'guardar']);

// Descarga de QR
Route::get('/descargar-qr/{id}', [VerificacionController::class, 'descargarQR']);