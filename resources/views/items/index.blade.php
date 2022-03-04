@extends('layouts.plantillabase')

@section('contenido')
<style>
    h5{
        margin: 0;
    }
</style>
    <div class="card p-2">
        <table class="table table-sm m-0">
            <tr>
                <td width="14%"><h5>Corto Plazo Accion:</h5></td>
                <td><h5>{!!$actividad->operacion->corto_plazo_accion->accion_corto_plazo!!}</h5></td>
            </tr>
            <tr>
                <td><h5>Presupuesto Asignado:</h5></td>
                <td><h5>{!!number_format($actividad->operacion->corto_plazo_accion->presupuesto_programado, 2, ".", ",")!!} Bs.</h5></td>
            </tr>
            <tr>
                <td><h5>Operacion:</h5></td>
                <td><h5>{!!$actividad->operacion->nombre_operacion!!}</h5></td>
            </tr>
            <tr>
                <td><h5>Actividad:</h5></td>
                <td><h5>{{$actividad->nombre_actividad}}</h5></td>
            </tr>
            <tr>
                <td width="15%"><h5>Presupuesto ejecutado:</h5></td>
                <td><h5>{!!number_format($accion->items->sum('presupuesto'), 2, '.', ',')!!} Bs.</h5></td>
            </tr>
        </table>

        <div class="">
            <ol class="breadcrumb m-0 mt-2 p-0 bg-white">
                <li class="breadcrumb-item text-muted">Actividades</li>
                <li class="breadcrumb-item"><b>Items</b></li>
            </ol>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-2">
            <h5 class="card-title m-0">Lista de Items</h5>
            <div>
                <a href="javascript:history.back()" class="btn btn-danger btn-sm mr-3">Volver Atrás</a>
                <button type="button" id="nuevo" class="btn btn-primary btn-sm">Nuevo Item</button>
            </div>
        </div>
        <div class="card-body p-2">
            <table id="items" class="table table-striped display operaciones" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th width='5%'>ID</th>
                        <th>Bien o Servicio</th>
                        <th>Fecha Requerida</th>
                        <th>Presupuesto</th>
                        <th>Partida</th>
                        <th width="12%"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    @include('items.modal_item.item_form')


@endsection

@section('js')
    
    <script src="{{asset('libs/js/validacionform/item_validar.js')}}"></script>
    <script>
        var actividad_uuid = "{!!$actividad->id!!}";
            $('#items').DataTable({
                "serverSide": true,
                "processing": true,
                "order": [[ 0, "desc" ]],
                "ajax": "/actividades/{!!$actividad->uuid!!}/items/",
                columns: [
                    { data: 'id', name: 'items.id'},
                    { data: 'bien_servicio', name: 'items.bien_servicio'},
                    { data: 'fecha_requerida', name: 'items.fecha_requerida'},
                    { 
                        data: 'presupuesto', name: 'items.presupuesto',
                        render: function(data, type) {
                        var number = $.fn.dataTable.render.number( ',', '.', 2, 'Bs ').display(data);
                            return number;
                        }
                    },
                    { data: 'nombre_partida', name: 'partidas.nombre_partida'},
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