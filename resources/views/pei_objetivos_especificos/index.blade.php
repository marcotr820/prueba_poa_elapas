@extends('layouts.plantillabase')

@section('contenido')
    <div class="card p-2">
        <div class="">
            <h5 class="m-0">Mediano Plazo Accion: " {{$mediano_plazo_accion->accion_mediano_plazo}} "</h5>
        </div>
        <div class="">
            <small>
                <ol class="breadcrumb m-0 p-0 bg-white float-sm-right">
                    <li class="breadcrumb-item text-muted">Home</li>
                    <li class="breadcrumb-item text-muted">Pilares</li>
                    <li class="breadcrumb-item text-muted">Metas</li>
                    <li class="breadcrumb-item text-muted">Resultados</li>
                    <li class="breadcrumb-item text-muted">Mediano Plazo Acciones</li>
                    <li class="breadcrumb-item"><b>Objetivo Especifico</b></li>
                </ol>
            </small>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-1 bg-primary">
            <h5 class="m-0 text-white"><b>Lista Objetivos Especificos</b></h5>
            <div>
                <a href="javascript:history.back()" class="btn btn-danger btn-sm mr-3">Volver Atrás</a>
                <button type="button" id="nuevo" class="btn btn-light btn-sm"><i class="fas fa-plus-circle"></i> Nueva Objetivo Especifico</button>
            </div>
        </div>
        <div class="card-body p-2">
            <table id="pei_objetivos_especificos" class="table table-striped display" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="30%">OBJETIVO ESPECIFICO</th>
                        <th width="18%">PONDERACION</th>
                        <th width="18%">INDICADOR DE PROCESO</th>
                        <th>GERENCIA</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('pei_objetivos_especificos.modal_pei_objetivo_especifico.pei_objetivo_especifico_form')

@endsection

@section('js')
    
    <script>
        var mediano_plazo_accion_uuid = "{!!$mediano_plazo_accion->uuid!!}";
        $('#pei_objetivos_especificos').DataTable({
            "order": [[ 0, "desc" ]],
            "serverSide": true,
            "processing": true,
            "ajax": "/mediano_plazo_acciones/{!!$mediano_plazo_accion->uuid!!}/pei_objetivos_especificos/",
            columns: [
                    { data: 'id', name:'pei_objetivos_especificos.id'},
                    { data: 'objetivo_institucional', name:'pei_objetivos_especificos.objetivo_institucional'},
                    { 
                        data: 'ponderacion', name:'pei_objetivos_especificos.ponderacion',
                        render: function( data, type, row)
                        {
                            return data + ' %';
                        }
                    },
                    { 
                        data: 'indicador_proceso', name:'pei_objetivos_especificos.indicador_proceso',
                        render: function( data, type, row)
                        {
                            return data + ' %';
                        }
                    },
                    { data: 'nombre_gerencia', name:'gerencias.nombre_gerencia'},
                    { 
                        data: 'uuid',
                        render: function( data, type, row)
                        {
                            return `
                            <div class="btn-group">
                                <button class="btn btn-primary btn-xm" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                                <button class="btn btn-danger btn-xm ml-1" data-delete="" onclick="delet('${data}')"><i class="fas fa-times-circle"></i></button>
                            </div>
                            `;
                        }
                    },
                ]
        });

    </script>

    <script src="{{asset('libs/js/validacionform/pei_objetivo_especifico_validar.js')}}"></script>

@endsection