<?php

namespace App\Http\Controllers;

use App\Models\MedianoPlazoAcciones;
use App\Models\Metas;
use App\Models\Pilares;
use App\Models\Resultados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as DPDF;

class DirectrizPoaController extends Controller
{
    public function index(){
        $pilares = Pilares::query()->select('id', 'nombre_pilar')
            // ->addSelect([
            //     'total_metas_pilar' => Metas::selectRaw('COUNT(*)')
            //     ->whereColumn('metas.pilar_id', 'pilares.id')
            // ])
            // ->addSelect([
            //     'total_resultados_pilar' => Resultados::selectRaw('COUNT(*)')
            //     ->join('metas', 'metas.id', '=', 'resultados.meta_id')
            //     ->whereColumn('metas.pilar_id', 'pilares.id')
            // ])
            // ->addSelect([
            //     'total_mediano_plazo_pilar' => MedianoPlazoAcciones::selectRaw('COUNT(*)')
            //     ->join('resultados', 'resultados.id', '=', 'mediano_plazo_acciones.resultado_id')
            //     ->join('metas', 'metas.id', '=', 'resultados.meta_id')
            //     ->whereColumn('metas.pilar_id', 'pilares.id')
            // ])
            ->get();
        return view('directriz_poa.index', compact('pilares'));
    }

    public function directriz_pdf()
    {
        // $pilares = Pilares::query()->select('id', 'nombre_pilar')
        //     ->addSelect([
        //         'total_mediano_plazo_pilar' => MedianoPlazoAcciones::selectRaw('COUNT(*)')
        //         ->join('resultados', 'resultados.id', '=', 'mediano_plazo_acciones.resultado_id')
        //         ->join('metas', 'metas.id', '=', 'resultados.meta_id')
        //         ->whereColumn('metas.pilar_id', 'pilares.id')
        //     ])
        //     ->get();
        // // $pdf = PDF::loadView('directriz_poa.directriz_pdf')->setOptions(['defaultFont' => 'sans-serif']);
        // // $pdf = PDF::loadView('directriz_poa.directriz_pdf', compact('pilares'));
        // return view('directriz_poa.directriz_pdf', compact('pilares'));
        $pilares = Pilares::query()->select('id', 'nombre_pilar')->get();
        $pdf = DPDF::loadView('directriz_poa.directriz_pdf', compact('pilares'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
