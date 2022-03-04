<?php

namespace App\Http\Controllers;

use App\Models\Actividades;
use App\Models\TareasEspecificas;
use Illuminate\Http\Request;

class TareaEspecificaController extends Controller
{
    public function index(Request $request, Actividades $actividad)
    {
        if($request->ajax())
        {
            $tareas_especificas = TareasEspecificas::where('actividad_id', $actividad->id);
            return datatables()
                ->eloquent($tareas_especificas)
                ->toJson();
        }
        return view('tareas_especificas.index', compact('actividad'));
    }

    public function store(Request $request, Actividades $actividad)
    {
        $request->validate([
            'nombre_tarea' => 'required',
            'resultado_esperado' => ['required', 'numeric']
        ]);

        TareasEspecificas::create([
            'nombre_tarea' => $request->nombre_tarea,
            'resultado_esperado' => $request->resultado_esperado,
            'actividad_id' => $actividad->id
        ]);
    }

    public function update(Request $request, TareasEspecificas $tarea_especifica)
    {
        $request->validate([
            'nombre_tarea' => 'required',
            'resultado_esperado' => ['required', 'numeric']
        ]);
        $tarea_especifica->update([
            'nombre_tarea' => $request->nombre_tarea,
            'resultado_esperado' => $request->resultado_esperado
        ]);
    }

    public function destroy(TareasEspecificas $tarea_especifica)
    {
        $tarea_especifica->delete();
    }
}
