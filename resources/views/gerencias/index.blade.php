@extends('layouts.plantillabase')

@section('contenido')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-2 bg-primary">
            <h5 class="card-title m-0 text-white font-weight-bolder">Lista de Gerencias</h5>
            <div class="mr-2">
                <button type="button" id="nueva_gerencia" class="btn btn-light btn-sm"><i class="fas fa-plus-circle"></i> Nuevo Gerencia</button>
            </div>
        </div>
        <div class="card-body p-2">
            {{-- <div class="loading"><h5>Loading...</h5></div> --}}
            <table id="gerencias" class="table table-striped display" style="width:100%;">
                <thead class="thead">
                    <tr>
                        <th>ID PILAR</th>
                        <th>NOMBRE GERENCIA</th>
                        <th width="15%">ACCIONES</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('gerencias.modal_gerencia.gerencia_form')

@endsection

@section('js')
    <script>
        $('#gerencias').DataTable({
            "serverSide": true,
            "processing": true,
            "order": [[ 0, "desc" ]],
            "ajax": "{{ route('gerencias.index') }}",
            columns: [
                    { data: 'id'},
                    { data: 'nombre_gerencia'},
                    { data: 'btn_gerencia'}
                ]
        });
    </script>
    <script src="{{asset('libs/js/validacionform/gerencia_validar.js')}}"></script>
@endsection