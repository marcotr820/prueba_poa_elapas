@extends('layouts.plantillabase')

@section('contenido')
    <div class="card p-2">
        <div class="">
            <h5>Rango de fechas:</h5>
        </div>
        <div class="">
            <form method="" class="d-flex" id="form_presupuestos">
                @csrf
                <div class="form-group mr-4">
                    <label for=""><b>fecha inicio</b><span class="text-danger"> *</span></label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                </div>
                <div class="form-group mr-4">
                    <label for=""><b>fecha fin</b><span class="text-danger"> *</span></label>
                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                </div>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center p-2 bg-primary">
            <h5 class="card-title m-0 text-white">Lista de Presupuestos Requeridos</h5>
            <div>
                <button type="button" id="generar_pdf" class="btn btn-light btn-sm"><i class="fas fa-file-pdf"></i> Exportar PDF</button>
            </div>
        </div>
        <div class="card-body p-2">
            <table id="presupuestos" class="table table-striped display" style="width:100%">
                <thead class="thead">
                    <tr>
                        <th>ACCION CORTO PLAZO</th>
                        <th>PRESUPUESTO REQUERIDO</th>
                        <th>FECHA SOLICITADA</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('presupuestos_requeridos.modal.modal_pdf')


@endsection

@section('js')
    
    <script src="{{asset('libs/js/validacionform/presupuestos_requeridos.js')}}"></script>
    <script>
        $('#presupuestos').DataTable();
    </script>

@endsection