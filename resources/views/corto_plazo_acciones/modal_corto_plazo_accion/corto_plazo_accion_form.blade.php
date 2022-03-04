<div class="modal fade animado" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="" method="" id="form">  
          @csrf
          <div class="modal-body">
            <div class="form-group">
                <label for="" class="col-form-label"><b>Nombre Accion Corto Plazo:</b></label>
                <textarea name="accion_corto_plazo" data-error="textarea" id="accion_corto_plazo" class="form-control"></textarea>
                <span class="text-danger" data-error="span" id="accion_corto_plazo-error"></span>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for=""><b>Gestion:</b></label>
                      <input type="text" data-error="input" class="form-control" name="gestion" id="gestion">
                      <span class="text-danger" data-error="span" id="gestion-error"></span>
                    </div>
                </div>
  
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""><b>Resultado Esperado:</b></label>
                        <input type="text" data-error="input" class="form-control" name="resultado_esperado" id="resultado_esperado">
                        <span class="text-danger" data-error="span" id="resultado_esperado-error"></span>
                    </div>
                </div>
  
            </div> 

            <div class="row">
              
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""><b>Fecha Inicio:</b></label>
                        <input type="date" data-error="input" class="form-control" name="fecha_inicio" id="fecha_inicio">
                        <span class="text-danger" data-error="span" id="fecha_inicio-error"></span>
                    </div>
                </div>
  
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""><b>Presupuesto Programado:</b></label>
                        <input type="text" data-error="input" class="form-control" name="presupuesto_programado" id="presupuesto_programado">
                        <span class="text-danger" data-error="span" id="presupuesto_programado-error"></span>
                    </div>
                </div>
  
            </div> 

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for=""><b>Fecha Fin:</b></label>
                        <input type="date" data-error="input" class="form-control" name="fecha_fin" id="fecha_fin">
                        <span class="text-danger" data-error="span" id="fecha_fin-error"></span>
                    </div>
                </div>
            </div>

            <span class="text-danger" id="fechasError"></span>

          </div>
          <div class="modal-footer">
            <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-light" data-dismiss="modal" id="btncancelar">Cancelar</button>
          </div>
        </form>

      </div>
    </div>
</div>

{{-- ***************************************** MODAL DELETE ************************************** --}}
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
            <button type="submit" id="confirm_delete" class="btn btn-danger">Borrar</button>
            <button type="button" class="btn btn-light" data-dismiss="modal" id="btncancelar">Cancelar</button>
          </div>
        </form>
  
      </div>
    </div>
</div>