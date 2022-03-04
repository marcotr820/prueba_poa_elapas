@extends('layouts.plantillabase')

@section('contenido')
    <div class="card p-1">
        <div class="">
            <h5><b>Pilar:</b> {{$meta->pilar->nombre_pilar}}</h5>
            <h5><b>-- Meta:</b> {{$meta->nombre_meta}}</h5>
        </div>
        <div class="">
            <small>
                <ol class="breadcrumb m-0 p-0 bg-white float-sm-right">
                    <li class="breadcrumb-item text-muted">Home</li>
                    <li class="breadcrumb-item text-muted">Pilares</li>
                    <li class="breadcrumb-item text-muted">Metas</li>
                    <li class="breadcrumb-item"><b>Resultados</b></li>
                </ol>
            </small>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-1 bg-primary">
            <h5 class="m-0 text-white"><b>Lista de Resultados</b></h5>
            <div>
                <a href="javascript:history.back()" class="btn btn-danger btn-sm mr-3">Volver Atrás</a>
                <button type="button" id="nuevo" class="btn btn-light btn-sm"><i class="fas fa-plus-circle"></i> Nuevo Resultado</button>
            </div>
        </div>
        <div class="card-body p-2">
            <table id="resultados" class="table display" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th>ID</th>
                        <th>RESULTADO</th>
                        <th width="25%"></th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>

    @include('resultados.modal_resultado.resultado_form')

@endsection

@section('js')
    
    <script>
        var meta_uuid = "{!!$meta->uuid!!}";
        $('#resultados').DataTable({
        "serverSide": true,
        "processing": true,
        "order": [[ 0, "desc" ]],
        "ajax": "/metas/{!!$meta->uuid!!}/resultados/",
        columns: [
            { data: 'id', name:'resultados.id'},
            { data: 'nombre_resultado'},
            {
                data: 'uuid',
                render: function( data, type, row)
                {
                    return `
                    <div class="btn-group">
                        <button class="btn btn-primary btn-xm" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                        <button class="btn btn-danger btn-xm ml-1" data-delete="" onclick="delet('${data}')"><i class="fas fa-times-circle"></i></button>
                        <button class='btn btn-outline-secondary btn-xm ml-4' data-mediano="">mediano plazo acciones</a>
                    </div>
                    `;
                }
            }
        ]
        });
    </script>

    <script src="{{asset('libs/js/validacionform/resultado_validar.js')}}"></script>

@endsection