@extends('layouts.plantillabase')

@section('contenido')
    <div class="card p-1">
        <div>
            <h5 class="m-0"><b>Pilar:</b> {{$pilar->nombre_pilar}}</h5>
        </div>
        <div class="">
            <small>
                <ol class="breadcrumb m-0 p-0 bg-white float-sm-right">
                    <li class="breadcrumb-item text-muted">Home</li>
                    <li class="breadcrumb-item text-muted">Pilares</li>
                    <li class="breadcrumb-item"><b>Metas</b></li>
                </ol>
            </small>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-1 bg-primary">
            <h5 class="m-0 text-white"><b>Lista de Metas</b></h5>
            <div>
                <a href="#" class="btn btn-danger btn-sm mr-3" onclick="window.location.href = document.referrer; return false;">Volver atras</a>
                <button type="button" id="nuevo" class="btn btn-light btn-sm"><i class="fas fa-plus-circle"></i> Nueva Meta</button>
            </div>
        </div>
        <div class="card-body p-2">
            <table id="metas" class="table table-striped display" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th width="5%">ID</th>
                        <th>META</th>
                        <th width="15%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('metas.modal_meta.meta_form')

@endsection

@section('js')
    <script>
        var pilar_uuid = "{!!$pilar->uuid!!}";
        $('#metas').DataTable({
            "serverSide": true,
            "processing": true,
            "order": [[ 0, "desc" ]],
            "ajax": '/pilares/{!!$pilar->uuid!!}/metas',
            columns: [
                    { data: 'id', name:'metas.id'},
                    { data: 'nombre_meta', name:'metas.nombre_meta'},
                    {
                        data: 'uuid',
                        render: function( data, type, row)
                        {
                            return `
                            <div class="btn-group">
                                <button class="btn btn-primary btn-xm" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                                <button class="btn btn-danger btn-xm ml-1" data-delete="" onclick="delet('${data}')"><i class="fas fa-times-circle"></i></button>
                                <button class='btn btn-outline-secondary btn-xm ml-4' data-resultados="">Resultados</a>
                            </div>
                            `;
                        }
                    }
                ]
        });
    </script>

    <script src="{{asset('libs/js/validacionform/meta_validar.js')}}"></script>

@endsection