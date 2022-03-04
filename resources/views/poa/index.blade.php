@extends('layouts.plantillabase')

@section('contenido')
    <div class="cabecera_pagina">
        <h5>Creacion poa lista de objetivos Especificos </h5>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="poa" class="table table-striped display" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="30%">OBJETIVO ESPECIFICO</th>
                        <th width="13%">PONDERACION</th>
                        <th width="20%">INDICADOR DE PROCESO</th>
                        <th width="15%">GERENCIA</th>
                        <th width=''></th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>

    @include('resultados.modal_resultado.resultado_form')

@endsection

@section('js')
    
    <script>

        $('#poa').DataTable({    
            "serverSide": true,
            "processing": true,
            "ajax": "{{ route('poa.index') }}",
            columns: [
                    { data: 'id', name:'pei_objetivos_especificos.id'},
                    { data: 'objetivo_institucional', name:'pei_objetivos_especificos.objetivo_institucional'},
                    { data: 'ponderacion', name:'pei_objetivos_especificos.ponderacion',
                        render: function( data, type, row)
                        {
                            return data + ' %';
                        }
                    },
                    { data: 'indicador_proceso', name:'pei_objetivos_especificos.indicador_proceso',
                        render: function( data, type, row)
                        {
                            return data + ' %';
                        }
                    },
                    { data: 'nombre_gerencia', name:'gerencias.nombre_gerencia'},
                    { data: 'uuid', name:'pei_objetivos_especificos.uuid',
                        render: function( data, type, row)
                        {
                            return '<button class="btn btn-primary btn-sm" data-accion="">Acciones Cotro Plazo</button>';
                        }
                    }
                ]
        });
    </script>

    <script src="{{asset('libs/js/validacionform/poa_validar.js')}}"></script>

@endsection