  @extends('layouts.plantillabase')

@section('contenido')
    <div class="card p-2">
        <div class="cabecera_pagina">
            <h5 class="m-0">Lista Acciones corto plazo</h5>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-2">
            <h5 class="card-title m-0">Planificacion y Evaluacion</h5>
        </div>
        <div class="card-body p-2">
            <table id="corto_plazo_acciones" class="table table-striped display" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th width="25%">accion corto plazo</th>
                        <th width="10%">fecha inicio</th>
                        <th width="10%">fecha fin</th>
                        <th width="5%">Planificacion</th>
                        <th width="5%">Evaluacion</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@section('js')
    
    <script>
        $('#corto_plazo_acciones').DataTable({    
            "serverSide": true,
            "processing": true,
            "order": [[ 0, "asc" ]],
            "ajax": "{{route('planificacion_evaluacion')}}",
            columns: [
                { data:'accion_corto_plazo'},
                { data:'fecha_inicio'},
                { data:'fecha_fin'},
                {
                    data: 'uuid',
                    render: function ( data, type, row ) {
                        return '<button class="btn btn-outline-primary btn-xm" data-planificacion="">Planificacion</button>';
                    }
                },
                {
                    data: 'corto_plazo_acciones.fecha_inicio',
                    //btn evaluacion
                    render: function ( data, type, row ) {
                        var fecha_inicio = Date.parse(row.fecha_inicio);
                        var fecha_fin = Date.parse(row.fecha_fin);
                        var fecha_actual = Date.now();
                        var poa_evaluacion = "{!!Auth::guard('usuario')->user()->trabajador->poa_evaluacion!!}";
                        if(fecha_actual > fecha_inicio && fecha_actual < fecha_fin && poa_evaluacion === '1'){
                            return '<button class="btn btn-outline-danger btn-xm" data-evaluar="">Evaluar</button>';
                        }
                        else{
                            return '';
                        }
                    }
                }
            ]
        });
    </script>

    <script src="{{asset('libs/js/validacionform/planificacion_evaluacion.js')}}"></script>

@endsection