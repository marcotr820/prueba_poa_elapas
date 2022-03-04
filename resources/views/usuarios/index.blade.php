@extends('layouts.plantillabase')

@section('contenido')
    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center p-1 bg-primary">
                <h5 class="card-title m-0 text-white font-weight-bolder">Lista de Usuarios</h5>
                <div class="">
                    <button type="button" id="nuevo" class="btn btn-light btn-sm"><i class="fas fa-plus-circle"></i> Nuevo Usuario</button>
                </div>
            </div>
            <div class="card-body p-2">
                <table id="usuarios" class="table table-striped display" style="width:100%">
                    <thead class="thead">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="15%">USUARIO</th>
                            <th width="40%">PASSWORD</th>
                            <th width="20%">TRABAJADOR</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    @include('usuarios.modal.form_usuarios')
    
@endsection


@section('js')

    <script>
    document.addEventListener('DOMContentLoaded', (e) => {
        $('#usuarios').DataTable({
            "serverSide": true,
            "processing": true,
            "order": [[ 0, "desc" ]],
            "ajax": "{{ route('usuarios.index') }}",
            columns: [
                // { data: 'usuario_id', name:'trabajadores.usuario_id'},
                // { data: 'usuario', name:'usuarios.usuario' },
                // { data: 'nombre', name:'trabajadores.nombre'},
                { data: 'id'},
                { data: 'usuario'},
                { data: 'password'},
                { data: 'nombre', name:'trabajadores.nombre'},
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
        });
    });
    </script>

    <script src="{{asset('libs/js/validacionform/validar_usuario.js')}}"></script>

@endsection