@extends('layouts.plantillabase')

@section('contenido')
    <div class="cabecera_pagina">
        <h4>Planificacion de AccionCortoPlazo: "{{$corto_plazo_accion->accion_corto_plazo}}"</h4>
        <h5>{{$corto_plazo_accion->fecha_inicio}}</h5>
        <h5>{{$corto_plazo_accion->fecha_fin}}</h5>
        {{-- <h4>{{$corto_plazo_accion->planificacion}}</h4> --}}
    </div>
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center p-2">
            <div><b>Planificacion:</b></div>
            <div id="buttons">
                <a href="javascript:history.back()" class="btn btn-danger btn-sm mr-2"><i class="fas fa-arrow-left"></i> Volver Atrás</a>
                @if (! $corto_plazo_accion->planificacion)
                    <button type="button" id="nuevo" class="btn btn-primary btn-sm">Crear Planificacion</button>
                @endif
            </div>
        </div>
        <div class="card-body p-2">
            <table id="planificacion" class="table table-striped display" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th width="22%">1er Trimestre</th>
                        <th width="22%">2do Trimestre</th>
                        <th width="22%">3er Trimestre</th>
                        <th width="22%">4to Trimestre</th>
                        <th width="12%"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    @include('planificacion.modal_planificacion.planificacion_form')

@endsection

@section('js')
    
    <script src="{{asset('libs/js/validacionform/planificacion_validar.js')}}"></script>
    <script>
        var corto_plazo_uuid = '{!!$corto_plazo_accion->uuid!!}';
        $('#planificacion').DataTable({
            "serverSide": true,
            "processing": true,
            "order": [[ 0, "desc" ]],
            "ajax": "/planificacion/"+ corto_plazo_uuid,
            columns: [
                { 
                    data: 'primer_trimestre',
                    render: function( data, type, row)
                    {
                        return data + ' %';
                    }
                },
                { 
                    data: 'segundo_trimestre',
                    render: function( data, type, row)
                    {
                        return data + ' %';
                    }
                },
                { 
                    data: 'tercer_trimestre',
                    render: function( data, type, row)
                    {
                        return data + ' %';
                    }
                },
                { 
                    data: 'cuarto_trimestre',
                    render: function( data, type, row)
                    {
                        return data + ' %';
                    }
                },
                {
                    data: 'uuid',
                    render: function( data, type, row){
                        var fecha_inicio = Date.parse(row.fecha_inicio);
                        var fecha_actual = Date.now();
                        if(fecha_actual < fecha_inicio){
                            //si la fecha actual es mayor a la inicial ya no se mostrara el boton de eliminar planificacion
                            return `
                                <div class="btn-group">
                                    <button class="btn btn-danger btn-xm ml-1" data-delete="" onclick="delet('${data}')"><i class="fas fa-times-circle"></i></button>
                                </div>
                            `;
                        }else{
                            return '';
                        }
                        
                    }
                }
            ]
        });
    </script>

@endsection