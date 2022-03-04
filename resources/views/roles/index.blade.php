@extends('layouts.plantillabase')

@section('contenido')
    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center p-2 bg-primary">
                <h5 class="card-title m-0 text-white font-weight-bolder">Lista de Roles</h5>
                <div class="">
                    <button type="button" id="nuevo_rol" class="btn btn btn-light btn-sm"><i class="fas fa-plus-circle"></i> Nuevo Rol</button>
                </div>
            </div>
            <div class="card-body p-2">
                <table id="roles" class="table table-striped display" style="width:100%">
                    <thead class="thead">
                        <tr>
                            <th width="10%">ID</th>
                            <th width="">Rol</th>
                            <th width="15%"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    @include('roles.modal_roles.rol_form')
    
@endsection


@section('js')

    <script>
        $('#roles').DataTable({
            "serverSide": true,
            "processing": true,
            "order": [[ 0, "desc" ]],
            "ajax": "{{route('roles.index')}}",
            columns: [
                { data: 'id'},
                { data: 'name'},
                {
                    data: 'id',
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

    <script src="{{asset('libs/js/validacionform/rol_validar.js')}}"></script>

@endsection