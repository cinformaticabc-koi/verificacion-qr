<?php

namespace App\Http\Controllers;

use App\Models\Gafete;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class VerificacionController extends Controller
{
    public function verificar($token)
    {
        $gafete = Gafete::where('token', $token)->first();
        
        if (!$gafete) {
            return view('verificacion.error', ['mensaje' => 'QR inválido']);
        }
        
        if ($gafete->estado === 'bloqueado') {
            return view('verificacion.error', ['mensaje' => 'Este encuestador ha sido bloqueado']);
        }
        
        if ($gafete->fecha_expiracion < now()) {
            return view('verificacion.error', ['mensaje' => 'QR expirado']);
        }
        
        return view('verificacion.detalle', compact('gafete'));
    }
    
    public function generar()
    {
        return view('verificacion.generar');
    }
    
    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required|unique:gafetes',
            'telefono' => 'required',
            'supervisor' => 'required',
            'municipio' => 'required'
        ]);
        
        $token = bin2hex(random_bytes(32));
        
        $gafete = Gafete::create([
            'token' => $token,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'telefono' => $request->telefono,
            'supervisor' => $request->supervisor,
            'municipio' => $request->municipio,
            'estado' => 'activo',
            'fecha_expiracion' => now()->addMonths(3)
        ]);
        
        // Generar URL para el QR
        $url = url("/validar/{$token}");
        
        // Generar código QR
        $qrCode = new QrCode($url);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        
        // Convertir a base64
        $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($result->getString());
        
        return redirect()->back()
            ->with('success', 'Gafete creado exitosamente')
            ->with('gafete', $gafete)
            ->with('qrCode', $qrCodeBase64)
            ->with('url', $url);
    }
    
    public function descargarQR($id)
    {
        $gafete = Gafete::find($id);
        
        if (!$gafete) {
            abort(404);
        }
        
        $url = url("/validar/{$gafete->token}");
        
        $qrCode = new QrCode($url);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        
        return response($result->getString())
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="gafete_' . $gafete->nombre . '_' . $gafete->id . '.png"');
    }
}