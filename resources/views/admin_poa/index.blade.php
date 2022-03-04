@extends('layouts.plantillabase')

@section('css')
<style>
   #directriz tr, th, td{
       border: 0.5px solid black;
       border-collapse: collapse;
       padding: 5px;
   }
   th{
       text-align: center;
   }
</style>
@endsection

@section('contenido')
    <div class="cabecera_pagina">
        <h5>Administrar POA presupuestos github</h5>
    </div>

    <div class="card">
        {{-- <div class="card-body"> --}}
        <table id="admin_poa" class="display" style="width:100%;">
            <thead class="thead bg-primary">
                <tr>
                    <th width='30%'>objetivo especifico</th>
                    <th>gerencia</th>
                    <th width='25%'>Accion corto plazo</th>
                    <th width='15%'>presupuesto programado</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($objetivos_especificos as $objetivo)
                    <tr>
                        <td rowspan="{{$objetivo->corto_plazo_acciones_count + 1}}">{{$objetivo->objetivo_institucional}}</td>
                        <td rowspan="{{$objetivo->corto_plazo_acciones_count + 1}}">{{$objetivo->nombre_gerencia}}</td>
                    </tr>

                    @foreach ($objetivo->corto_plazo_acciones as $corto_plazo_accion)
                        <tr>
                            <td id="{{$corto_plazo_accion->id}}">{{$corto_plazo_accion->accion_corto_plazo}}</td>
                            <td>Bs. {{ number_format($corto_plazo_accion->presupuesto_programado, 2)}}</td>
                            @if($corto_plazo_accion->status === '1')
                                <td><button class="btn btn-danger btn-sm px-3" id="btn"><i class="far fa-eye"></i></button></td>
                            @else
                                <td><button class="btn btn-primary btn-sm px-3" id="btn"><i class="far fa-eye"></i></button></td>
                            @endif
                        </tr>
                    @endforeach

                @endforeach
            </tbody>

            @include('admin_poa.modal_admin_poa.admin_poa_form')

        </table>
        {{-- </div> --}}
    </div>

@endsection

@section('js')
    <script>
        // var tabla_admin_poa = $('#admin_poa').DataTable({

        // });
    </script>
    <script src="{{asset('libs/js/admin_poa.js')}}"></script>

@endsection