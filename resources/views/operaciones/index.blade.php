@extends('layouts.plantillabase')

@section('contenido')
    <div class="card p-2">
        <div class="">
            <h5 class="m-0">AccionCortoPlazo: "{{$corto_plazo_accion->accion_corto_plazo}}"</h5>
        </div>
        <div class="">
            <ol class="breadcrumb m-0 mt-2 p-0 bg-white">
                <li class="breadcrumb-item text-muted">Accion Corto Plazo</li>
                <li class="breadcrumb-item"><b>Operaciones</b></li>
            </ol>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-2">
            <h5 class="card-title m-0">Lista de Operaciones</h5>
            <div class="mr-2">
                <a href="javascript:history.back()" class="btn btn-danger btn-sm mr-3"><i class="fas fa-arrow-left"></i> Volver Atrás</a>
                <button type="button" id="nuevo" class="btn btn-primary btn-sm">Nueva Operacion</button>
            </div>
        </div>
        <div class="card-body p-2">
            <table id="operaciones" class="table table-bordered table-striped" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th width='5%'>ID</th>
                        <th>OPERACION</th>
                        <th width="15%"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    @include('operaciones.modal_operacion.operacion_form')

@endsection

@section('js')
    
    <script src="{{asset('libs/js/validacionform/operacion_validar.js')}}"></script>
    <script>
            var accion_corto_uuid = "{!!$corto_plazo_accion->uuid!!}";
            $('#operaciones').DataTable({
                "serverSide": true,
                "processing": true,
                "pageLength": 8,
                "lengthMenu": [[8, 15, 30, -1], [8, 15, 30, "Todos"]],
                "order": [[ 0, "desc" ]],
                "ajax": "/corto_plazo_acciones/{!!$corto_plazo_accion->uuid!!}/operaciones",
                columns: [
                    { data: 'id'},
                    { data: 'nombre_operacion'},
                    {
                        data: 'uuid',
                        render: function( data, type, row)
                        {
                            return `
                            <div class="btn-group">
                                <button class="btn btn-primary btn-xm" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                                <button class="btn btn-danger btn-xm ml-1" data-delete="" onclick="delet('${data}')"><i class="fas fa-times-circle"></i></button>
                                <button class='btn btn-outline-secondary btn-xm ml-4' data-actividades="">Actividades</a>
                            </div>
                            `;
                        }
                    }
                ]   
            });
    </script>


@endsection