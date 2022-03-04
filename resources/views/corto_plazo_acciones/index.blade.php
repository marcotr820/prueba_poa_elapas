@extends('layouts.plantillabase')

@section('contenido')
    <div class="card p-2">
        <div class="cabecera_pagina">
            <h5 class="m-0">Objetivo de Gestion: " {{$pei_objetivo_especifico->objetivo_institucional}} "</h5>
        </div>
        <div class="">
            {{-- <ol class="breadcrumb float-sm-right"> --}}
            <ol class="breadcrumb m-0 mt-2 p-0 bg-white">
                <li class="breadcrumb-item text-muted">Objetivo Gestion</li>
                <li class="breadcrumb-item"><b>Corto Plazo Acciones</b></li>
            </ol>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-2 bg-primary">
            <h5 class="card-title m-0 text-white font-weight-bolder">Lista Acciones Corto Plazo</h5>
            <div>
                <a href="javascript:history.back()" class="btn btn-danger btn-sm mr-3">Volver Atrás</a>
                <button type="button" id="nuevo" class="btn btn-light btn-sm"><i class="fas fa-plus-circle"></i> Nueva Accion Corto Plazo</button>
            </div>
        </div>
        <div class="card-body p-2">
            <table id="corto_plazo_acciones" class="table table-striped display" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th width="25%">ACCION CORTO PLAZO</th>
                        <th width="10%">GESTION</th>
                        <th width="15%">RESULTADO ESPERADO</th>
                        <th width="15%">PRESUPUESTO ASIGNADO</th>
                        <th width="10%">FECHA INICIO</th>
                        <th width="10%">FECHA FIN</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('corto_plazo_acciones.modal_corto_plazo_accion.corto_plazo_accion_form')

@endsection

@section('js')
    
    <script>
        var pei_uuid = "{!!$pei_objetivo_especifico->uuid!!}";
        $('#corto_plazo_acciones').DataTable({    
            "serverSide": true,
            "processing": true,
            "order": [[ 0, "asc" ]],
            "ajax": "/pei_objetivos_especifico/{!!$pei_objetivo_especifico->uuid!!}/corto_plazo_acciones/",
            columns: [
                    { data: 'accion_corto_plazo'},
                    { data: 'gestion'},
                    { data: 'resultado_esperado'},
                    { 
                        data: 'presupuesto_programado',
                        render: function(data, type) {
                        var number = $.fn.dataTable.render.number( ',', '.', 2, 'Bs ').display(data);
                            return number;
                        }
                    },
                    { data: 'fecha_inicio'},
                    { data: 'fecha_fin'},
                    {
                        data: 'status',
                        render: function( data, type, row)
                        {
                            switch(data){
                                case '0':
                                    return `
                                    <button class="btn btn-primary btn-xm" data-edit="" onclick="edit('${data.uuid}')"><i class="fas fa-pen"></i></button>
                                    `;
                                break;

                                case '1':
                                    return `
                                    <button class="btn btn-primary btn-xm" data-edit="" onclick="edit('${data.uuid}')"><i class="fas fa-pen"></i></button>
                                    <button class="btn btn-danger btn-xm" data-delete="" onclick="delet('${data.uuid}')"><i class="fas fa-times-circle"></i></button>
                                    `;
                                break;

                                case '2':
                                    return `
                                    <button class="btn btn-outline-danger btn-sm" data-planificacion="">Planificacion</button>
                                    `;
                                break;

                                case '3':
                                    return `
                                    <button class='btn btn-outline-secondary btn-sm' data-operaciones="">operaciones</button>
                                    `;
                                break;

                                case '4':
                                    return `
                                    <button class='btn btn-outline-primary btn-sm'>Monitoreo</button>
                                    `;
                                break;
                            }
                        }
                    }
                ]
        });
    </script>

    <script src="{{asset('libs/js/validacionform/corto_plazo_accion_validar.js')}}"></script>

@endsection