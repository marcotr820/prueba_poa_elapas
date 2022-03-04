<?php

namespace App\Http\Controllers;

use App\Http\Requests\PilarRequest;
use App\Models\Pilares;
use Illuminate\Http\Request;

class PilarController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            return datatables()
                ->eloquent(Pilares::query()->select('id', 'nombre_pilar', 'gestion_pilar', 'uuid')->where('gestion_pilar', date('Y')))
                // ->addColumn('btn_pilares', view('pilares.acciones_pilar'))
                ->toJson();
        }
        return view('pilares.index');
    }

    public function store(PilarRequest $request)
    {
        Pilares::create([
            'nombre_pilar' => strtoupper($request->nombre_pilar),
            'gestion_pilar' => $request->gestion_pilar
        ]); 
    }

    public function update(PilarRequest $request, Pilares $pilar)
    {
        // $pilar->update($request->only(['nombre_pilar', 'gestion_pilar']));
        $pilar->update([
            'nombre_pilar' => strtoupper($request->nombre_pilar),
            'gestion_pilar' => $request->gestion_pilar,
        ]);
    }

    public function destroy(Pilares $pilar)
    {
        $pilar->delete();
    }
}
