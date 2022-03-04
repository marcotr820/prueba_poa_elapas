<?php

namespace App\Http\Controllers;

use App\Http\Requests\GerenciaRequest;
use App\Models\Gerencias;
use Illuminate\Http\Request;

class GerenciaController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            return datatables()
                ->eloquent(Gerencias::query()
                    ->select('id', 'nombre_gerencia'))
                ->addColumn('btn_gerencia', view('gerencias.acciones_gerencia'))
                ->toJson();
        }
        //$gerencias = Gerencias::all();
        return view('gerencias.index');
    }

    public function store(GerenciaRequest $request)
    {
        Gerencias::create([
            'nombre_gerencia' => strtoupper($request->nombre_gerencia),
        ]);
    }

    public function update(GerenciaRequest $request, Gerencias $gerencia)
    {
        $gerencia->update([
            'nombre_gerencia' => strtoupper($request->nombre_gerencia),
        ]);
    }

    public function destroy(Gerencias $gerencia)
    {
        $gerencia->delete();
    }
}
