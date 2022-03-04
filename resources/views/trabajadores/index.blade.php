@extends('layouts.plantillabase')

@section('contenido')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-1 bg-primary">
            <h5 class="card-title m-0 text-white font-weight-bolder">Lista de Trabajadores</h5>
            <div class="mr-2">
                <button type="button" id="nuevo" class="btn btn-light btn-sm"><i class="fas fa-plus-circle"></i> Nuevo Trabajador</button>
            </div>
        </div>
        <div class="card-body p-2">
            <div class="loading"><b><h5 class="m-0">Loading...</h5></b></div>
            <article style="display:none;">
                <table id="trabajadores" class="table table-striped display" style="width:100%;">
                    <thead class="thead">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="10%">DOCUMENTO</th>
                            <th width="15%">NOMBRE</th>
                            <th width="15%">CARGO</th>
                            <th width="15%">UNIDAD</th>
                            <th width="15%">GERENCIA</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    
                </table>
            </article>
        </div>
    </div>

    @include('trabajadores.modal_trabajador.form_trabajador')

@endsection

@section('js')
    <script>
    document.addEventListener("DOMContentLoaded", (e)=>{
        $('#trabajadores').DataTable({
        // "initComplete": function( settings, json ) {
        // document.getElementById('trabajadores').style.display = 'table';
        // document.querySelector('.loading').style.display = 'none';
        // },
        "serverSide": true,
        "processing": true,
        "order": [[ 0, "desc" ]],
        "ajax": "{{ route('trabajadores.index') }}",
        columns: [
            { data: 'id', name: 'trabajadores.id'},
            { data: 'documento', name: 'trabajadores.documento'},
            { data: 'nombre', name: 'trabajadores.nombre'},
            { data: 'cargo', name:'trabajadores.cargo'},
            { data: 'nombre_unidad', name:'unidades.nombre_unidad'},
            { data: 'nombre_gerencia', name:'gerencias.nombre_gerencia'},
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
        ],
        }).on('xhr.dt', function ( e, settings, json, xhr ){
            document.querySelector('article').style.display = 'block';
            document.querySelector('.loading').style.display = 'none';
        });
    });

    </script>

    <script src="{{asset('libs/js/validacionform/validar_trabajador.js')}}"></script>
@endsection