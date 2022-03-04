<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Gerencias;
use App\Models\PeiObjetivosEspecificos;
use Illuminate\Http\Request;

class PoaController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $objetivos = Gerencias::join('pei_objetivos_especificos', 'gerencias.id', '=', 'pei_objetivos_especificos.gerencia_id')
                ->select('gerencias.nombre_gerencia', 'pei_objetivos_especificos.*')
                ->where('gerencias.id', Auth::guard('usuario')->user()->trabajador->unidad->gerencia->id);

            return datatables()
            ->eloquent($objetivos)
            ->addColumn('btn_poas', view('poa.acciones_poa'))
            ->toJson();
        }
        return view('poa.index');
    }
}
