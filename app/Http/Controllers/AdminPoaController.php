<?php

namespace App\Http\Controllers;

use App\Models\CortoPlazoAcciones;
use App\Models\PeiObjetivosEspecificos;
use Illuminate\Http\Request;

class AdminPoaController extends Controller
{
    //
    public function index()
    {
        $objetivos_especificos = PeiObjetivosEspecificos::join('gerencias', 'gerencias.id', '=', 'pei_objetivos_especificos.gerencia_id')
            ->select('pei_objetivos_especificos.*', 'gerencias.nombre_gerencia')
            ->withCount('corto_plazo_acciones')->get();
        return view('admin_poa.index', compact('objetivos_especificos'));
    }

    public function updateStatusAccionCortoPlazo(Request $request, $id_corto_plazo_accion)
    {
        $data = CortoPlazoAcciones::find($id_corto_plazo_accion);
        $data->update([
            'status' => $request->status,
        ]);
    }
}
