<div class="modal fade animado" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" id="form">  
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group documento">
                    <label for=""><b>Documento <span class="text-danger">*</span></b></label>
                    <input type="text" data-error="input" class="form-control" id="documento" name="documento">
                    <span class="text-danger" data-error="span" id="documento-error"></span>
                  </div>
              </div>
        
              <div class="col-md-6">
                  <div class="form-group">
                      <label for=""><b>Unidad <span class="text-danger">*</span></b></label>
                      <select data-error="select" id="unidad_id" class="form-control" name="unidad_id">
                        <option value="">Seleccione...</option>
                        @foreach ($unidades as $unidad)
                          <option value="{{$unidad->id}}">{{$unidad->nombre_unidad}}</option>
                        @endforeach
                      </select>
                      <span class="text-danger" data-error="span" id="unidad_id-error"></span>
                  </div>
              </div>
            </div> 
        
            <div class="form-group">
              <label for="" class=""><b>Nombre <span class="text-danger">*</span></b></label>
              <input type="text" data-error="input" id="nombre" class="form-control" name="nombre" autocomplete="off">
              <span class="text-danger" data-error="span" id="nombre-error"></span>
            </div>
        
            <div class="form-group">
              <label for=""><b>Cargo <span class="text-danger">*</span></b></label>
              <input id="cargo" data-error="input" name="cargo" class="form-control" type="text" autocomplete="off">
              <span class="text-danger" data-error="span" id="cargo-error"></span>
            </div>
        </div>

        <div class="modal-footer">
          <button type="submit" id="btnGuardar" class="btn btn-primary">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Guardar
          </button>
          <button type="button" class="btn btn-light" data-dismiss="modal" id="btncancelar">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ******************************************************************************************************************* --}}
<div class="modal fade animado" id="modal_delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Borrar Trabajador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="" method="" id="form_delete">  
        @csrf
        <div class="modal-body p-3">
          <div>
            ¿Esta seguro de eliminar a <b><span class="message bg-light text-danger p-1"></span></b> ? ¡Una vez eliminado, se perderá para siempre!
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Borrar</button>
          <button type="button" class="btn btn-light" data-dismiss="modal" id="btncancelar">Cancelar</button>
        </div>
      </form>

    </div>
  </div>
</div>