<?php

namespace App\Http\Controllers;

use App\Models\CortoPlazoAcciones;
// use Barryvdh\DomPDF\Facade as PDF;
use Elibyy\TCPDF\Facades\TCPDF as PDF;
use Illuminate\Http\Request;

class PresupuestosRequeridosController extends Controller
{
    public function lista_presupuestos(Request $request)
    {
        if($request->ajax())
        {
            $acciones = CortoPlazoAcciones::query()->whereBetween('fecha_inicio', [$request->get('fecha_inicio'), $request->get('fecha_fin')]);
            return datatables()
                ->eloquent($acciones)
                ->toJson();
        }

        return view('presupuestos_requeridos.index');
        
    }

    public function presupuestos_pdf($f_inicio = '', $f_fin = '')
    {
        $datos = CortoPlazoAcciones::get()->whereBetween('fecha_inicio', [$f_inicio, $f_fin]);
        $view = view('presupuestos_requeridos.presupuestos_pdf', compact('datos'));
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

        // PDF::SetMargins(7, 18, 7);
        PDF::SetAutoPageBreak(TRUE, 12); /*margin bottom*/
        PDF::SetMargins(5, 19, 5, true);   //SetMargins($left, $top, $right = -1, $keepmargins = false)
        PDF::addPage('L', 'A4'); //hoja horizontal carta
        PDF::writeHTML($html, true, false, true, false, '');
        PDF::Output('pdfXd.pdf', 'I');
    }
}
