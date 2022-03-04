<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartidaRequest;
use App\Models\Partidas;
use Illuminate\Http\Request;

class PartidaController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            return datatables()
                ->eloquent(Partidas::query())
                ->addColumn('btn_partida', view('partidas.btn_partida'))
                ->toJson();
        }
        return view('partidas.index');
    }

    public function store(PartidaRequest $request)
    {
        Partidas::create([
            'nombre_partida' => $request->nombre_partida,
            'codigo_partida' => $request->codigo_partida,
            'tipo_partida' => $request->tipo_partida
        ]);
    }
    public function update(PartidaRequest $request, Partidas $partida)
    {
        $partida->update([
            'nombre_partida' => $request->nombre_partida,
            'codigo_partida' => $request->codigo_partida,
            'tipo_partida' => $request->tipo_partida
        ]);
    }

    public function destroy(Partidas $partida)
    {
        $partida->delete();
    }
}
