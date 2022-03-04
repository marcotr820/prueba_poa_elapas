<div class="modal fade animado" id="modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="" method="POST" id="form">  
          @csrf  
          <div class="modal-body">
              <div class="form-group">
                <label for="" class="col-form-label"><b>Usuario:</b></label>
                <select class="form-control select2" data-error="select" id="trabajador_id" name="trabajador_id" style="width:100%;">
                  <option value="">seleccione...</option>
                </select>
                <span class="text-danger error-text" data-error="span" id="trabajador_id-error"></span>
              </div>

              <div class="form-group">
                <label for="Password"><b>Password:</b></label>
                <input class="validacion form-control" data-error="input" type="password" id="password" name="password">
                <span class="text-danger error-text" data-error="span" id="password-error"></span>
              </div>

              <div class="form-group m-0">
                <label for="" class="col-form-label"><b>Listado de Roles:</b></label>
                @foreach ($roles as $role)
                  <div>
                    <label>
                      <input type="checkbox" data-role="rol{{$role->id}}" class="mr-1" name="roles[]" value="{{$role->id}}">
                      <b>{{$role->name}}</b>
                    </label>
                  </div>
                @endforeach
                <span class="text-danger error-text" data-error="span" id="roles-error"></span>
              </div>

          </div>
          <div class="modal-footer">
            <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
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
        <h5 class="modal-title">Borrar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="" method="" id="form_delete">  
        @csrf
        <div class="modal-body p-3">
          <div>
            ¿Esta seguro de eliminar a <b><span class="message bg-light text-danger p-1"></span></b>? ¡Una vez eliminado, se perderá para siempre!
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Borrar</button>
          <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
        </div>
      </form>

    </div>
  </div>
</div>