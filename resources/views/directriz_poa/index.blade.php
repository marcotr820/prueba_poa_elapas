@extends('layouts.plantillabase')

@section('css')
    <style>
        #directriz th, td{
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
    <div class="cabecera_pagina d-flex justify-content-between align-items-center p-2">
        <h5 class="card-title m-0">Directriz POA</h5>
        <div class="mr-2">
            <a type="button" href="{{route('directriz_pdf')}}" class="btn btn-primary btn-sm">Generar PDF</a>
        </div>
    </div>

    <div class="card">
        {{-- <div class="card-body"> --}}
        <table id="directriz" class="" style="width:100%;">
            <thead class="thead bg-primary">
               <tr>
                  <th>PILAR</th>
                  <th>META</th>
                  <th>RESULTADO</th>
                  <th>ACCION MEDIANO PLAZO</th>
              </tr>
            </thead>

            <tbody>
               @foreach ($pilares as $pilar)
                  <tr>
                  <td rowspan="{{$pilar->metas->count() + $pilar->resultados->count() + $pilar->mediano_plazo_acciones->count() + 1}}">{{$pilar->nombre_pilar}}</td>
                  </tr>
                  @foreach ($pilar->metas as $meta)
                     <tr>
                     <td rowspan="{{$meta->resultados->count() + $meta->acciones_mediano_plazo->count() + 1}}">{{$meta->nombre_meta}}</td>
                     </tr>
                     @foreach ($meta->resultados as $resultado)
                        <tr>
                        <td rowspan="{{$resultado->acciones_mediano_plazo->count() + 1}}">{{$resultado->nombre_resultado}}</td>
                        </tr>
                        @foreach ($resultado->acciones_mediano_plazo as $amp)
                           <tr>
                           <td rowspan="">{{$amp->accion_mediano_plazo}}</td>
                           </tr>
                        @endforeach
                     @endforeach
                  @endforeach
               @endforeach
            </tbody>

            {{-- @include('admin_poa.modal_admin_poa.admin_poa_form') --}}

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