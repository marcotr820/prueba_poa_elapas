@extends('layouts.plantillabase')

@section('contenido')
    <div class="card p-1">
        <div class="">
            <ol class="breadcrumb m-0 p-0 bg-white">
                <li class="breadcrumb-item text-muted">Home</li>
                <li class="breadcrumb-item"><b>Pilares</b></li>
            </ol>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-1 bg-primary">
            <h5 class="m-0 text-white"><b>Lista de Pilares</b></h5>
            <div class="mr-2">
                {{-- <a href="{{route('directriz_poa.index')}}" class="btn btn-warning btn-sm mr-3">Directriz POA PDF</a> --}}
                <button class="btn btn-warning btn-sm mr-3" data-directriz=""><i class="fas fa-file-pdf"></i> Directriz POA</button>
                <a href="javascript:history.back()" class="btn btn-danger btn-sm mr-3"><i class="fas fa-arrow-left"></i> Volver Atrás</a>
                <button type="button" id="nuevo" class="card-title btn btn-light btn-sm m-0"><i class="fas fa-plus-circle"></i> Nuevo Pilar</button>
            </div>
        </div>
        <div class="card-body p-2">
            <table id="pilares" class="table table-striped display" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th>ID</th>
                        <th>PILAR</th>
                        <th>GESTION</th>
                        <th width="17%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('pilares.modal_pilar.form_pilar')

@endsection

@section('js')
    <script>
        $('#pilares').DataTable({
            "serverSide": true,
            "processing": true,
            "order": [[ 0, "desc" ]],
            "ajax": "{{ route('pilares.index') }}",
            columns: [
                    { data: 'id'},
                    { data: 'nombre_pilar'},
                    { data: 'gestion_pilar'},
                    // { data: 'btn_pilares'},
                    {
                        data: 'uuid',
                        render: function( data, type, row)
                        {
                            return `
                            <div class="btn-group">
                                <button class="btn btn-primary btn-xm" data-edit="" onclick="edit('${data}')"><i class="fas fa-pen"></i></button>
                                <button class="btn btn-danger btn-xm ml-1" data-delete="" onclick="delet('${data}')"><i class="fas fa-times-circle"></i></button>
                                <button class='btn btn-outline-secondary btn-xm ml-4' data-metas="">Metas</a>
                            </div>
                            `;
                        }
                    }
                ],
            "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button>Click!</button>"
            } ]
        });
    </script>

    <script src="{{asset('libs/js/validacionform/pilar_validar.js')}}"></script>

@endsection