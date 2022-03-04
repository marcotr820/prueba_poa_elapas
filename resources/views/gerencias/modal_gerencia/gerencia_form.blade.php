<div class="modal fade animado" id="modal_gerencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="{{route('gerencias.store')}}" method="POST" id="form_gerencia" class="">  
          @csrf  
          <div class="modal-body">

            <div class="form-group">
              <!--campo donde guardaremos el id para editar-->
              <input type="hidden" id="id_gerencia" class="form-control">

              <label class="col-form-label"><b>Nombre Gerencia <span class="text-danger">*</span></b></label>
              <input type="text" id="nombre_gerencia" class="form-control" name="nombre_gerencia" autocomplete="off" data-required="">
              <span class="text-danger error-text" id="nombre_gerenciaError"></span>
      
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