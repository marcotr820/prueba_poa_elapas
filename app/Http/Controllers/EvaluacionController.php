<?php

namespace App\Http\Controllers;

use App\Models\CortoPlazoAcciones;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    public function index(CortoPlazoAcciones $corto_plazo_accion)
    {
        $fecha_actual = Carbon::now();
        $f1 = Carbon::createFromDate("2021-03-12");
        $f2 = Carbon::createFromDate("2021-05-05");
        // return $f1->diffInDays($f2); //diferencia de dias

        $fecha_inicio = Carbon::createFromDate($corto_plazo_accion->fecha_inicio);
        $fecha_fin = Carbon::createFromDate($corto_plazo_accion->fecha_fin);
        if($corto_plazo_accion->planificacion){//si se logra ingresar a evaluaciones y no se cuenta con una planificacion se devolvera valores vacios para no generar error
            if($fecha_actual >= $fecha_inicio && $fecha_actual <= $fecha_fin){
                if($fecha_actual->month == 2 || $fecha_actual->month == 4 || $fecha_actual->month == 5 || $fecha_actual->month == 6){
                    $resultado_esperado = $corto_plazo_accion->planificacion->primer_trimestre;
                    $trimestre = "primer_trimestre";
                }
                elseif($fecha_actual->month == 7 || $fecha_actual->month == 8 || $fecha_actual->month == 9){
                    $resultado_esperado = $corto_plazo_accion->planificacion->segundo_trimestre;
                    $trimestre = "segundo_trimestre";
                }
                elseif($fecha_actual->month == 10 || $fecha_actual->month == 11 || $fecha_actual->month == 12){
                    $resultado_esperado = $corto_plazo_accion->planificacion->tercer_trimestre;
                    $trimestre = "tercer_trimestre";
                }
                elseif($fecha_actual->month == 1){
                    $resultado_esperado = $corto_plazo_accion->planificacion->cuarto_trimestre;
                    $trimestre = "cuarto_trimestre";
                }
                else{
                    $trimestre = "";
                    $resultado_esperado = ""; 
                }
            }
        }
        else{
            $resultado_esperado = "";
            $trimestre = "";
        }

        return view('evaluaciones.index', compact('corto_plazo_accion', 'trimestre', 'resultado_esperado'));
    }
}
