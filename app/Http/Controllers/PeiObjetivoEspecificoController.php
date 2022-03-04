<?php
namespace App\Http\Controllers;

use App\Http\Requests\PeiObjetivoEspecificoRequest;
use App\Models\Gerencias;
use App\Models\MedianoPlazoAcciones;
use App\Models\PeiObjetivosEspecificos;
use Illuminate\Http\Request;

class PeiObjetivoEspecificoController extends Controller
{
    public function index(Request $request, MedianoPlazoAcciones $mediano_plazo_accion)
    {
        if($request->ajax())
        {
            $data = Gerencias::join('pei_objetivos_especificos', 'gerencias.id', '=', 'pei_objetivos_especificos.gerencia_id')
                ->select(
                    'gerencias.nombre_gerencia', 'pei_objetivos_especificos.objetivo_institucional', 
                    'pei_objetivos_especificos.id', 'pei_objetivos_especificos.ponderacion', 
                    'pei_objetivos_especificos.indicador_proceso', 'pei_objetivos_especificos.uuid',
                    'pei_objetivos_especificos.gerencia_id'
                )
                ->where('pei_objetivos_especificos.mediano_plazo_accion_id', $mediano_plazo_accion->id);

            return datatables()
                ->eloquent($data)
                ->toJson();
        }
        $gerencias = Gerencias::query()->select('id', 'nombre_gerencia')->get();
        return view('pei_objetivos_especificos.index', compact('gerencias', 'mediano_plazo_accion'));
    }

    public function store(PeiObjetivoEspecificoRequest $request, MedianoPlazoAcciones $mediano_plazo_accion)
    {
        PeiObjetivosEspecificos::create([
            'objetivo_institucional' => strtoupper($request->objetivo_institucional),
            'ponderacion' => $request->ponderacion,
            'indicador_proceso' => $request->indicador_proceso,
            'gerencia_id' => $request->gerencia_id,
            'mediano_plazo_accion_id' => $mediano_plazo_accion->id
        ]);
    }

    public function update(PeiObjetivoEspecificoRequest $request, PeiObjetivosEspecificos $pei_objetivo_especifico)
    {
        $pei_objetivo_especifico->update([
            'objetivo_institucional' => strtoupper($request->objetivo_institucional),
            'ponderacion' => $request->ponderacion,
            'indicador_proceso' => $request->indicador_proceso,
            'gerencia_id' => $request->gerencia_id
        ]);

    }

    public function destroy(PeiObjetivosEspecificos $pei_objetivo_especifico)
    {
        $pei_objetivo_especifico->delete();
    }
}
