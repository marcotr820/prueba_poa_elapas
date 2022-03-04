<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadRequest;
use App\Models\Gerencias;
use App\Models\Unidades;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $unidades = Unidades::join("gerencias", "gerencias.id", "=", "unidades.gerencia_id")->select("unidades.*", "gerencias.nombre_gerencia");
            return datatables()
                ->eloquent($unidades)
                ->addColumn('btn_unidades', view('unidades.acciones_unidad'))
                ->toJson();
        }
        
        $gerencias = Gerencias::query()->select('id', 'nombre_gerencia')->get();
        return view('unidades.index', compact('gerencias'));
    }

    public function store(UnidadRequest $request)
    {
        Unidades::create([
            'nombre_unidad' => strtoupper($request->nombre_unidad),
            'gerencia_id' => $request->gerencia_id,
        ]);
    }

    public function update(UnidadRequest $request, Unidades $unidad)
    {
        $unidad->update([
            'nombre_unidad' => strtoupper($request->nombre_unidad),
            'gerencia_id' => $request->gerencia_id,
        ]);
    }

    public function destroy($id_unidad)
    {
        $unidad = Unidades::find($id_unidad);
        $unidad->delete();
    }
}
