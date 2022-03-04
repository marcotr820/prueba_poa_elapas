<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetaRequest;
use App\Models\Metas;
use App\Models\Pilares;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    public function index(Request $request, Pilares $pilar)
    {
        if($request->ajax())
        {
            $metas = Metas::join("pilares", "pilares.id", "=", "metas.pilar_id")
                    ->select("metas.id", "metas.nombre_meta", "metas.uuid")
                    ->where('metas.pilar_id', $pilar->id);

            return datatables()
                ->eloquent($metas)
                // ->addColumn('btn_metas', 'metas.acciones_meta')
                // ->rawColumns(['btn_metas'])
                ->toJson();
        }
        return view('metas.index', compact('pilar'));
    }

    public function store(MetaRequest $request,Pilares $pilar)
    {
        Metas::create([
            'nombre_meta' => strtoupper($request->nombre_meta),
            'pilar_id' => $pilar->id,
        ]);
    }

    public function update(MetaRequest $request,Metas $meta)
    {
        $meta->update([
            'nombre_meta' => strtoupper($request->nombre_meta),
        ]);
    }

    public function destroy(Metas $meta)
    {
        $meta->delete();
    }
}
