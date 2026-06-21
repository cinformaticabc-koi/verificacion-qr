<?php

namespace App\Http\Controllers;

use App\Models\Gafete;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGafetes = Gafete::count();
        $gafetesActivos = Gafete::where('estado', 'activo')->count();
        $gafetesBloqueados = Gafete::where('estado', 'bloqueado')->count();
        $gafetesProxAExpirar = Gafete::where('fecha_expiracion', '<', now()->addDays(7))->count();
        
        $gafetes = Gafete::orderBy('created_at', 'desc')->paginate(10);
        
        return view('dashboard.index', compact(
            'totalGafetes',
            'gafetesActivos',
            'gafetesBloqueados',
            'gafetesProxAExpirar',
            'gafetes'
        ));
    }
    
    public function bloquear($id)
    {
        $gafete = Gafete::find($id);
        $gafete->estado = $gafete->estado === 'activo' ? 'bloqueado' : 'activo';
        $gafete->save();
        
        return redirect()->back()->with('success', 'Gafete actualizado');
    }
    
    public function eliminar($id)
    {
        $gafete = Gafete::find($id);
        $gafete->delete();
        
        return redirect()->back()->with('success', 'Gafete eliminado');
    }
}