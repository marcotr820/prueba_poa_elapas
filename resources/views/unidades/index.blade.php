@extends('layouts.plantillabase')

@section('contenido')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-2 bg-primary">
            <h5 class="card-title m-0 text-white font-weight-bolder">Lista de Unidades</h5>
            <div class="mr-2">
                <button type="button" id="nueva_unidad" class="btn btn-light btn-sm"><i class="fas fa-plus-circle"></i> Nuevo Unidad</button>
            </div>
        </div>
        <div class="card-body p-2">
            <table id="unidades" class="table table-striped display" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th>ID</th>
                        <th>UNIDAD</th>
                        <th>GERENCIA</th>
                        <th width="15%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('unidades.modal_unidades.unidad_form')

@endsection

@section('js')
<script>
    $('#unidades').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[ 0, "desc" ]],
        // "ajax": "{{ url('datatable/unidad') }}", //otra forma de llamar a la ruta por su url
        "ajax": "{{ route('unidades.index') }}",
        columns: [
            {data: 'id', name: 'unidades.id'},
            {data: 'nombre_unidad', name: 'unidades.nombre_unidad'},
            {data: 'nombre_gerencia', name: 'gerencias.nombre_gerencia'},
            {data: 'btn_unidades'}
        ]
    });
</script>
<script src="{{asset('libs/js/validacionform/unidad_validar.js')}}"></script>
@endsection