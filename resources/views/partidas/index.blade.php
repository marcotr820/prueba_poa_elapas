@extends('layouts.plantillabase')

@section('contenido')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-1 bg-primary">
            <h5 class="m-0 text-white font-weight-bolder">Lista Partidas</h5>
            <button type="button" id="nuevo" class="btn btn-light btn-sm"><i class="fas fa-plus-circle"></i> Nueva Partida</button>
        </div>
        <div class="card-body p-2">
            <table id="partidas" class="table table-striped display operaciones" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th width='5%'>id</th>
                        <th>Partida</th>
                        <th>Codigo Partida</th>
                        <th>Tipo Partida</th>
                        <th width="12%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('partidas.modal_partida.partida_form')


@endsection

@section('js')
    
    <script src="{{asset('libs/js/validacionform/partida_validar.js')}}"></script>
    <script>
      document.addEventListener('DOMContentLoaded', (e) => {
        var tabla_partidas = $('#partidas').DataTable({ //declaramos variable global
               "serverSide": true,
               "processing": true,
               "order": [0, "desc"],
               "ajax": "{{ route('partidas.index' )}}",
               columns: [
                  { data: 'id'},
                  { data: 'nombre_partida'},
                  { data: 'codigo_partida'},
                  { data: 'tipo_partida'},
                  { data: 'btn_partida'}
               ]  
         })

      });
    </script>

@endsection