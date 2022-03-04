@extends('layouts.plantillabase')

@section('contenido')
    <div class="card p-2">
        <div class="">
            <h5>Corto Plazo Accion: "{!!$operacion->corto_plazo_accion->accion_corto_plazo!!}"</h5>
            <h5>Operacion: "{{$operacion->nombre_operacion}}"</h5>
        </div>
        <div class="">
            <ol class="breadcrumb m-0 mt-2 p-0 bg-white">
                <li class="breadcrumb-item text-muted">Operaciones</li>
                <li class="breadcrumb-item"><b>Actividades</b></li>
            </ol>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-2">
            <h5 class="card-title m-0">Lista de Actividades</h5>
            <div>
                <a href="javascript:history.back()" class="btn btn-danger btn-sm mr-3">Volver Atrás</a>
                <button type="button" id="nuevo" class="btn btn-primary btn-sm">Nueva Actividad</button>
            </div>
        </div>
        <div class="card-body p-2">
            <table id="actividades" class="table table-striped display operaciones" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th width='5%'>id</th>
                        <th>Actividad</th>
                        <th>Resultado esperado</th>
                        <th width='20%'></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    @include('actividades.modal_actividad.actividad_form')


@endsection

@section('js')
    
    <script src="{{asset('libs/js/validacionform/actividad_validar.js')}}"></script>
    <script>
        var operacion_uuid = "{!!$operacion->uuid!!}";
        $('#actividades').DataTable({
            "serverSide": true,
            "processing": true,
            "order": [[ 0, "desc" ]],
            "ajax": "/operaciones/{!!$operacion->uuid!!}/actividades",
            columns: [
                { data: 'id'},
                { data: 'nombre_actividad'},
                { data: 'resultado_esperado'},
                {
                    data: 'uuid',
                    render: function( data, type, row)
                    {
                        return `
                        <div class="btn-group">
                            <button class="btn btn-primary btn-xm mr-2" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-xm" data-delete="" onclick="delet('${data}')"><i class="fas fa-times-circle"></i></button>
                            <button class='btn btn-outline-secondary btn-xm ml-5' data-tareas="">Tareas</a>
                            <button class='btn btn-outline-secondary btn-xm ml-3' data-items="">Items</a>
                        </div>
                        `;
                    }
                }
            ]  
        })
    </script>

@endsection