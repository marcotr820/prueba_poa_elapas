
<div class="modal fade animado" id="modal_unidad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="{{route('unidades.store')}}" method="POST" id="form_unidad" class="">  
          @csrf  
          <div class="modal-body">

            <div class="form-group">
              <!--campo donde guardaremos el id para editar-->
              <input type="hidden" id="id_unidad" class="form-control">
              <label for="" class="col-form-label"><b>Nombre Unidad: <span class="text-danger">*</span></b></label>
              <input type="text" id="nombre_unidad" class="form-control" name="nombre_unidad" autocomplete="off">
              <span class="text-danger error-text" id="nombre_unidadError"></span>
            </div>

            <div class="form-group">
              <label for=""><b>Gerencia: <span class="text-danger">*</span></b></label>
              <select id="gerencia" class="form-control custom-select" name="gerencia_id">
                <option value="">Seleccione...</option>
                @foreach ($gerencias as $gerencia)
                <option value="{{$gerencia->id}}">{{$gerencia->nombre_gerencia}}</option>
                @endforeach
              </select>
              <span class="text-danger error-text" id="gerencia_idError"></span>
            </div>

          </div>
          <div class="modal-footer">
              <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
              <button type="button" class="btn btn-light" data-dismiss="modal" id="btncancelar">Cancelar</button>
          </div>
        </form>

      </div>
    </div>
</div>