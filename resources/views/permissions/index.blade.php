@extends('layouts.plantillabase')

@section('contenido')
    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center p-2 bg-primary">
                <h5 class="card-title m-0 text-white font-weight-bolder">Lista de Permisos</h5>
                <div class="">
                    <button type="button" id="nuevo_permission" class="btn btn-light btn-sm"><i class="fas fa-plus-circle"></i> Nuevo Permiso</button>
                </div>
            </div>
            <div class="card-body p-2">
                <table id="permisos" class="table table-striped display" style="width:100%">
                    <thead class="thead">
                        <tr>
                            <th width="">ID</th>
                            <th width="">PERMISO</th>
                            <th width="15%"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    @include('permissions.modal_permissions.permissions_form')
    
@endsection


@section('js')

    <script>
    document.addEventListener('DOMContentLoaded', (e) => {
            $('#permisos').DataTable({ //declaramos variable global
                "serverSide": true,
                "processing": true,
                "order": [[ 0, "desc" ]],
                "ajax": "{{route('permissions.index')}}",
                columns: [
                    { data: 'id'},
                    { data: 'name'},
                    { data: 'btn_permissions'},
                ]  
            })
    });
    </script>

    <script src="{{asset('libs/js/validacionform/permission_validar.js')}}"></script>

@endsection