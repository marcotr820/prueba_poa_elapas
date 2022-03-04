<?php

namespace App\Http\Controllers;

use App\Models\CortoPlazoAcciones;
use App\Models\Trabajadores;
// use Barryvdh\DomPDF\Facade as PDF;
use Elibyy\TCPDF\Facades\TCPDF as PDF;
use Illuminate\Http\Request;

class EstadoTrabajadorController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $trabajadores = Trabajadores::join('unidades', 'unidades.id', '=', 'trabajadores.unidad_id')
                            ->join('gerencias', 'gerencias.id', '=', 'unidades.gerencia_id')
                            ->join('usuarios', 'usuarios.trabajador_id', '=', 'trabajadores.id')
                            ->select('trabajadores.*', 'unidades.nombre_unidad', 'gerencias.nombre_gerencia');

            return datatables()
                ->eloquent($trabajadores)
                // ->addColumn('btn_estado_trabajadores', 'estado_trabajadores.btn_estado_trabajadores')
                // ->rawColumns(['btn_estado_trabajadores'])
                ->toJson();
        }
        return view('estado_trabajadores.index');
    }

    public function poa_status(Request $request, $id_trabajador)
    {
        $trabajador = Trabajadores::find($id_trabajador);
        $trabajador->update([
            'poa_status' => $request->poa_status
        ]);
    }

    public function poa_evaluacion(Request $request, $id_trabajador)
    {
        $trabajador = Trabajadores::find($id_trabajador);
        $trabajador->update([
            'poa_evaluacion' => $request->poa_evaluacion,
        ]);
    }

    public function habilitar_creacion_all()
    {
        $trabajadores = Trabajadores::select('trabajadores.*')->join('usuarios', 'usuarios.trabajador_id', '=', 'trabajadores.id')->get();
        foreach($trabajadores as $trabajador){
            $trabajador->update([
                'poa_status' => '1'
            ]);
        }
        // return view('estado_trabajadores.index');
    }

    public function deshabilitar_creacion_all(){
        $trabajadores = Trabajadores::select('trabajadores.*')->join('usuarios', 'usuarios.trabajador_id', '=', 'trabajadores.id')->get();
        foreach($trabajadores as $trabajador){
            $trabajador->update([
                'poa_status' => '0'
            ]);
        }
        // return view('estado_trabajadores.index');
    }

    public function operaciones_tareas(Trabajadores $trabajador)
    {
        // $data_trabajador = Trabajadores::where('trabajadores.id', $trabajador->id)
        // ->addSelect([
        //     'total_tareas_especificas' => TareasEspecificas::selectRaw('COUNT(*)')
        //     ->join('actividades', 'actividades.id', '=', 'tareas_especificas.actividad_id')
        //     ->join('operaciones', 'operaciones.id', '=', 'actividades.operacion_id')
        //     ->join('corto_plazo_acciones', 'corto_plazo_acciones.id', '=', 'operaciones.corto_plazo_accion_id')
        //     ->whereColumn('corto_plazo_acciones.trabajador_id', 'trabajadores.id')
        // ])->first();

        // return $data_trabajador->withCount('corto_plazo_acciones')->get();
        return view('reporte_operaciones_tareas.index', compact('trabajador'));
    }

    public function operaciones_tareas_pdf(Trabajadores $trabajador)
    {
        $acciones_corto_plazo = CortoPlazoAcciones::where('trabajador_id', $trabajador->id)->with('operaciones')->get();
        // return view('reporte_operaciones_tareas.reporte_pdf', compact('trabajador', 'acciones_corto_plazo'));
        $view = view('reporte_operaciones_tareas.reporte_pdf', compact('trabajador', 'acciones_corto_plazo'));
        $html = $view->render();
        PDF::SetTitle('TITULO_ejemplooo');
        // Custom Header
        PDF::setHeaderCallback(function($pdf) {
            $image_file = K_PATH_IMAGES.'logo_elapas.png'; //vendor/tecnickcom/examples/images
            $pdf->Image($image_file, 5, 2, 32, '', 'PNG', '', 'T', false, 200, '', false, false, 0, false, false, false);
            // Set font
            $pdf->Ln(3); /*centrar y dar margin-top al title ESPACIO ENTRE LINEAS*/
            $pdf->SetFont('helvetica', 'B', 12);
            // Title
            $pdf->Cell(0, 7, 'Reporte PDF TCPDF!!!', 0, 1, 'C', 0, '', 0, false, 'M', 'M');

            $pdf->Ln(1); /*ESPACIO ENTRE LINEAS*/
            $pdf->SetFont('helvetica', '', 10);
            $pdf->Cell(0, 5, 'Trabajador:', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
            $pdf->Ln(2);
            $pdf->Cell(0, 5, 'Gestion:____ Gerengia:____', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        });
        // Custom Footer
        PDF::setFooterCallback(function($pdf) {
                // Position at 15 mm from bottom
                $pdf->SetY(-12);
                // Set font
                $pdf->SetFont('helvetica', 'I', 8);
                date_default_timezone_set('America/La_Paz');
                $fecha = date("Y-m-d H:i:s");
                // Page number
                $pdf->Cell(0,10,$fecha,0,0,'L');
                $pdf->Cell(10, 10, 'Página '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        });

        // PDF::SetTitle('My Report');
        // PDF::SetMargins(7, 18, 7);
        PDF::SetAutoPageBreak(TRUE, 12); /*margin bottom*/
        PDF::SetMargins(5, 19, 5, true);   //SetMargins($left, $top, $right = -1, $keepmargins = false)
        PDF::addPage('L', 'A4'); //hoja horizontal carta
        PDF::writeHTML($html, true, false, true, false, '');
        PDF::Output('pdfXd.pdf', 'I');
    }
}
