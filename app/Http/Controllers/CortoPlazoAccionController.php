<?php

namespace App\Http\Controllers;

use App\Http\Requests\CortoPlazoAccionRequest;
use App\Models\CortoPlazoAcciones;
use App\Models\PeiObjetivosEspecificos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class CortoPlazoAccionController extends Controller
{
    public function planificacion_evaluacion(Request $request)
    {
        if($request->ajax())
        {
            $corto_plazo_acciones = CortoPlazoAcciones::where('trabajador_id', Auth::guard('usuario')->user()->trabajador->id);
            return datatables()
                ->eloquent($corto_plazo_acciones)
                // ->addColumn('btn_planificacion_evaluacion', 'corto_plazo_acciones.btn_planificacion_evaluacion')
                // ->rawColumns(['btn_planificacion_evaluacion'])
                ->toJson();
        }
        
        return view('corto_plazo_acciones.lista_planificacion_evaluacion');
    }

    public function StatusCortoPlazoAccion($id_corto_plazo_accion)  //consulta para ver el estado de la accion corto plazo
    {
        return CortoPlazoAcciones::select('status')->where('id', $id_corto_plazo_accion)->first();
    }

    public function index(Request $request, PeiObjetivosEspecificos $pei_objetivo_especifico)
    {
        if($request->ajax())
        {
            $acciones_corto_plazo = CortoPlazoAcciones::where('pei_objetivo_especifico_id', $pei_objetivo_especifico->id)
                    ->select('corto_plazo_acciones.*')
                    ->where('trabajador_id', Auth::guard('usuario')->user()->trabajador->id);

            return DataTables::of($acciones_corto_plazo) //de la consulta usamos el $status para usarlo en la vista de los botones
                // ->addColumn('btn_corto_plazo', 'corto_plazo_acciones.btn_corto_plazo_accion')
                // ->rawColumns(['btn_corto_plazo'])
                ->toJson();
        }
        $data = CortoPlazoAcciones::query()->get();
        return view('corto_plazo_acciones.index', compact('data', 'pei_objetivo_especifico'));
    }

    public function store(CortoPlazoAccionRequest $request, PeiObjetivosEspecificos $pei_objetivo_especifico)
    {
        $carbon_fecha_inicio = Carbon::parse($request->fecha_inicio);
        $carbon_fecha_fin = Carbon::parse($request->fecha_fin);
        if($carbon_fecha_inicio->month <= $carbon_fecha_fin->month){ //retornamos error en la condicion para registrar
            CortoPlazoAcciones::create([
                'gestion' => $request->gestion,
                'accion_corto_plazo' => $request->accion_corto_plazo,
                'resultado_esperado' => $request->resultado_esperado,
                'presupuesto_programado' => $request->presupuesto_programado,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'trabajador_id' => Auth::guard('usuario')->user()->trabajador->id,
                'pei_objetivo_especifico_id' => $pei_objetivo_especifico->id
            ]);
        }
        else{
            throw ValidationException::withMessages([
                'fechas' => ['La fecha inicio no puede ser mayor que la fecha final']
            ]);
        }
          
    }

    public function update(CortoPlazoAccionRequest $request, CortoPlazoAcciones $corto_plazo_accion)
    {
        $corto_plazo_accion->update([
            'gestion' => $request->gestion,
            'accion_corto_plazo' => $request->accion_corto_plazo,
            'resultado_esperado' => $request->resultado_esperado,
            'presupuesto_programado' => $request->presupuesto_programado,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'status' => '1'
        ]);
    }

    public function destroy(CortoPlazoAcciones $corto_plazo_accion)
    {
        $corto_plazo_accion->delete();
    }

}
