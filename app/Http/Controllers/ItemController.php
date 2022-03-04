<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Actividades;
use App\Models\Items;
use App\Models\Partidas;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request, Actividades $actividad)
    {
        if($request->ajax())
        {
            $items = Actividades::join('items', 'actividades.id', '=', 'items.actividad_id')
                ->join('partidas', 'items.partida_id', '=', 'partidas.id')
                ->select('partidas.nombre_partida', 'items.*')
                ->where('actividades.id', $actividad->id);

            return datatables()
                ->eloquent($items)
                ->toJson();
        }
        $partidas = Partidas::query()->get();
        $accion = $actividad->operacion->corto_plazo_accion;
        return view('items.index', compact('actividad', 'partidas', 'accion'));
    }

    public function store(ItemRequest $request, $actividad)
    {
        Items::create([
            'bien_servicio' => $request->bien_servicio,
            'fecha_requerida' => $request->fecha_requerida,
            'presupuesto' => $request->presupuesto,
            'partida_id' => $request->partida_id,
            'actividad_id' => $actividad
        ]);
    }

    public function update(ItemRequest $request, Items $item)
    {
        $item->update([
            'bien_servicio' => $request->bien_servicio,
            'fecha_requerida' => $request->fecha_requerida,
            'presupuesto' => $request->presupuesto,
            'partida_id' => $request->partida_id
        ]);
    }

    public function destroy(Items $item)
    {
        $item->delete();
    }
}
