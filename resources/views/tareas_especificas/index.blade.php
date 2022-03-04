@extends('layouts.plantillabase')

@section('contenido')
    <div class="card p-2">
        <div class="">
            <h5>Corto Plazo Accion: "{!!$actividad->operacion->corto_plazo_accion->accion_corto_plazo!!}"</h5>
            <h5>Operacion: "{!!$actividad->operacion->nombre_operacion!!}"</h5>
            <h5>Actividad: "{{$actividad->nombre_actividad}}"</h5>
        </div>
        <div class="">
            <ol class="breadcrumb m-0 mt-2 p-0 bg-white">
                <li class="breadcrumb-item text-muted">Actividades</li>
                <li class="breadcrumb-item"><b>Tareas Especificas</b></li>
            </ol>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-2">
            <h5 class="card-title m-0">Lista de Tareas Especificas</h5>
            <div>
                <a href="javascript:history.back()" class="btn btn-danger btn-sm mr-3">Volver Atrás</a>
                <button type="button" id="nuevo" class="btn btn-primary btn-sm">Nueva Tarea</button>
            </div>
        </div>
        <div class="card-body p-2">
            <table id="tareas_especificas" class="table table-striped display operaciones" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th width='5%'>id</th>
                        <th>Actividad</th>
                        <th>Resultado esperado</th>
                        <th width="15%"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    @include('tareas_especificas.modal_tarea_especifica.tarea_especifica_form')


@endsection

@section('js')
    
    <script src="{{asset('libs/js/validacionform/tarea_especifica_validar.js')}}"></script>
    <script>
        var actividad_uuid = "{!!$actividad->uuid!!}";
        $('#tareas_especificas').DataTable({
            "serverSide": true,
            "processing": true,
            "order": [[ 0, "desc" ]],
            "ajax": "/actividades/{!!$actividad->uuid!!}/tareas_especificas/",
            columns: [
                { data: 'id'},
                { data: 'nombre_tarea'},
                { data: 'resultado_esperado'},
                {
                    data: 'uuid',
                    render: function( data, type, row)
                    {
                        return `
                            <button class="btn btn-primary btn-xm" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                            <button class="btn btn-danger btn-xm" data-delete="" onclick="delet('${data}')"><i class="fas fa-times-circle"></i></button>
                        `;
                    }
                }
            ]  
        })
    </script>

@endsection