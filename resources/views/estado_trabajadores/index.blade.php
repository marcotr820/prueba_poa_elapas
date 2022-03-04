@extends('layouts.plantillabase')

@section('css')
<style>
    #cambio_estado th, td{
        padding: 1px;
    }
</style>
@endsection

@section('contenido')
    <div class="d-flex justify-content-between align-items-center m-0">
        <h5 class="card-title m-0">Administrar Estado Trabajadores</h5>
        <div>
            <table id="cambio_estado" class="m-0">
                <thead class="text-center">
                    <th>Crear POA</th>
                    <th>Evaluar POA</th>
                </thead>
                <tbody>
                    <td>
                        <button data-habilitar="creacion" class="btn btn-success btn-sm m-0 mr-2">habilitar todos</button>
                        <button data-deshabilitar="creacion" class="btn btn-danger btn-sm m-0 mr-5">deshabilitar todos</a>
                    </td>
                    <td>
                        <p class="btn btn-success btn-sm m-0 mr-2">habilitar todos</p>
                        <p class="btn btn-primary btn-sm m-0">deshabilitar todos</p>
                    </td>
                </tbody>
            </table>
        </div>
    </div>
    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    
    <!--token para cambiar de estado-->
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <div class="card">
        <div class="card-body">
            <table id="estados_trabajadores" class="table table-striped display" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th width='20%'>trabajador</th>
                        <th width='20%'>Unidad</th>
                        <th width='20%'>gerencia</th>
                        <th width='15%'>Crear POA</th>
                        <th width='15%'>Evaluar POA</th>
                        <th width='10%'></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@section('js')
    
    <script type="text/javascript">
        $('#estados_trabajadores').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": "{{ route('estados_trabajadores.index') }}",
            columns: [
                    { data: 'nombre', name:'trabajadores.nombre'},
                    { data: 'nombre_unidad', name:'unidades.nombre_unidad'},
                    { data: 'nombre_gerencia', name:'gerencias.nombre_gerencia'},
                    { 
                        data: 'poa_status', name:'trabajadores.poa_status',
                        render: function( data, type, row)
                        {
                            if(data === '0') 
                            {
                                return ` <div class="custom-control custom-switch" id="estado_poa"> 
                                    <input type="checkbox" name="poa_status" class="custom-control-input _switch" id="${row["id"]}"> 
                                    <label class="custom-control-label" for="${row["id"]}"> 
                                        <span class="badge badge-danger p-1">deshabilitado</span> 
                                    </label> 
                                    </div> `;
                            }
                            else
                            {
                                return ` <div class="custom-control custom-switch" id="estado_poa"> 
                                    <input type="checkbox" name="poa_status" class="custom-control-input" id="${row["id"]}" checked> 
                                    <label class="custom-control-label" for="${row["id"]}"> 
                                        <span class="badge badge-success p-1">Activo</span> 
                                    </label> 
                                        </div> `;
                            }
                        }
                    },
                    { 
                        data: 'poa_evaluacion', name:'trabajadores.poa_evaluacion',
                        render: function( data, type, row){
                            if(data === '0')
                            {
                                return ` <div class="custom-control custom-switch"> 
                                    <input type="checkbox" name="poa_evaluacion" data-evaluar="" class="custom-control-input" id="${row["id"]}evaluacion"> 
                                    <label class="custom-control-label" for="${row["id"]}evaluacion"> 
                                        <span class="badge badge-danger p-1">deshabilitado</span> 
                                    </label> 
                                    </div> `;
                            }
                            else
                            {
                                return ` <div class="custom-control custom-switch"> 
                                    <input type="checkbox" name="poa_evaluacion" data-evaluar="" class="custom-control-input" id="${row["id"]}evaluacion" checked> 
                                    <label class="custom-control-label" for="${row["id"]}evaluacion"> 
                                        <span class="badge badge-success p-1">Activo</span> 
                                    </label> 
                                    </div> `;
                            }
                        }
                    },
                    {
                        data:'uuid', name:'trabajadores.uuid',
                        render: function( data, type, row){
                            return `
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-secondary btn-xm" data-operaciones="">Operaciones</button>
                                <button type="button" class="btn btn-outline-primary btn-xm" data-requerimientos="">Requerimientos</button>
                            </div>
                            `;
                        }
                    }
                    
                ]
        });

    </script>

    <script src="{{asset('libs/js/estado_trabajadores.js')}}"></script>

@endsection