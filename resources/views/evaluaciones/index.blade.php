@extends('layouts.plantillabase')

@section('contenido')
    <div class="card p-2">
        <div class="">
            <h5 class="m-0"><b>Corto Plazo Accion:</b> "{{$corto_plazo_accion->accion_corto_plazo}}"</h5>
        </div>
        <div class="">
            <ol class="breadcrumb m-0 mt-2 p-0 bg-white">
                <li class="breadcrumb-item text-muted">Corto Plazo Accion</li>
                <li class="breadcrumb-item"><b>Evaluacion</b></li>
            </ol>
        </div>
        <hr>
        <div>
            <table width="50%">
                <tr>
                    <th>fecha inicio: {!!$corto_plazo_accion->fecha_inicio!!}</th>
                    <th>fecha fin: {!!$corto_plazo_accion->fecha_fin!!}</th>
                    <th>dias transcurridos: </th>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-2 bg-primary">
            <h5 class="card-title m-0 text-white font-weight-bolder">Lista de Evaluaciones</h5>
            <div>
                <a href="javascript:history.back()" class="btn btn-danger btn-sm mr-3">Volver Atrás</a>
                @if ($trimestre)
                  <button type="button" id="nuevo" class="btn btn-light btn-sm"><i class="fas fa-plus-circle"></i> Evaluar</button>
                @endif
            </div>
        </div>
        <div class="card-body p-0">
            <table id="" class="table table-bordered display" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th colspan="3" class="text-center">Resultados</th>
                        <th colspan="3" class="text-center">Presupuesto</th>
                        <th>relacion de avance</th>
                        <tr>
                            <th>Esperados</th>
                            <th>Logrados</th>
                            <th>Eficacia %</th>
                            <th>Aprobado</th>
                            <th>Ejecutado</th>
                            <th>Ejecucion %</th>
                            <th>Avance %</th>
                        </tr>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    @include('evaluaciones.modal_evaluacion.evaluacion_form')


@endsection

@section('js')
   <script src="{{asset('libs/js/validacionform/evaluacion_validar.js')}}"></script>
@endsection