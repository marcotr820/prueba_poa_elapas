<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperacionRequest;
use App\Models\CortoPlazoAcciones;
use App\Models\Operaciones;
use Illuminate\Http\Request;

class OperacionController extends Controller
{
    public function index(Request $request, CortoPlazoAcciones $corto_plazo_accion)
    {
        if($request->ajax())
        {
            $operaciones = Operaciones::where('corto_plazo_accion_id', $corto_plazo_accion->id);
            return datatables()
                ->eloquent($operaciones)
                ->toJson();
        }
        return view('operaciones.index', compact('corto_plazo_accion'));
    }

    public function store(OperacionRequest $request, CortoPlazoAcciones $corto_plazo_accion)
    {
        Operaciones::create([
            'nombre_operacion' => $request->nombre_operacion,
            'corto_plazo_accion_id' => $corto_plazo_accion->id
        ]);
    }

    public function update(OperacionRequest $request, Operaciones $operacion)
    {
        $operacion->update($request->only(['nombre_operacion']));
    }

    public function destroy(Operaciones $operacion)
    {
        $operacion->delete();
    }
}
