@extends('layouts.plantillabase')

@section('contenido')
    <div class="card p-1">
        <div class="">
            <h5><b>Pilar:</b> {{$resultado->meta->pilar->nombre_pilar}}</h5>
            <h5><b>Meta:</b> {{$resultado->meta->nombre_meta}}</h5>
            <h5 class="m-0"><b>Resultado:</b> {{$resultado->nombre_resultado}}</h5>
        </div>
        <div class="">
            <small>
                <ol class="breadcrumb m-0 p-0 bg-white float-sm-right">
                    <li class="breadcrumb-item text-muted">Home</li>
                    <li class="breadcrumb-item text-muted">Pilares</li>
                    <li class="breadcrumb-item text-muted">Metas</li>
                    <li class="breadcrumb-item text-muted">Resultados</li>
                    <li class="breadcrumb-item"><b>Mediano Plazo Accion</b></li>
                </ol>
            </small>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-1 bg-primary">
            <h5 class="m-0 text-white"><b>Lista Mediano Plazo acciones</b></h5>
            <div>
                <a href="javascript:history.back()" class="btn btn-danger btn-sm mr-3">Volver Atrás</a>
                <button type="button" id="nuevo" class="btn btn-light btn-sm"><i class="fas fa-plus-circle"></i> Nueva Accion Mediano Plazo</button>
            </div>
        </div>
        <div class="card-body p-2">
            <table id="acciones_mediano_plazo" class="table table-striped display" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th>ID</th>
                        <th>ACCION MEDIANO PLAZO</th>
                        <th width="25%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('mediano_plazo_acciones.modal_mediano_plazo_accion.mediano_plazo_accion_form')

@endsection

@section('js')
    
    <script>
        var resultado_uuid = "{!!$resultado->uuid!!}";
        $('#acciones_mediano_plazo').DataTable({
            "serverSide": true,
            "processing": true,
            "order": [[ 0, "desc" ]],
            "ajax": "/resultados/{!!$resultado->uuid!!}/acciones_mediano_plazo",
            columns: [
                { data: 'id', name:'mediano_plazo_acciones.id'},
                { data: 'accion_mediano_plazo', name:'mediano_plazo_acciones.accion_mediano_plazo'},
                {
                    data: 'uuid',
                    render: function( data, type, row)
                    {
                        return `
                        <div class="btn-group">
                            <button class="btn btn-primary btn-xm" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-xm ml-1" data-delete="" onclick="delet('${data}')"><i class="fas fa-times-circle"></i></button>
                            <button class='btn btn-outline-secondary btn-xm ml-4' data-objetivo_gestion="">objetivo gestion</a>
                        </div>
                        `;
                    }
                }
            ]
        });

    </script>

    <script src="{{asset('libs/js/validacionform/mediano_plazo_accion_validar.js')}}"></script>

@endsection