<div class="modal fade animado" id="modal_admin_poa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="exampleModalLabel">Accion Corto Plazo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="" method="" id="form_status_admin_poa" class="">
          @csrf
          <input type="hidden" id="id_corto_plazo_accion" name="id_corto_plazo_accion" class="form-control">
          <div class="modal-body">

          <fieldset class="container">
              <div class="custom-control custom-radio mb-2">
                <input class="form-check-input" type="radio" name="status" id="radio0" value="0">
                <label class="form-check-label text-dark" for="radio0"><b>Editar Presupuesto</b></label>
              </div>
              <div class="custom-control custom-radio mb-2">
                <input class="form-check-input" type="radio" name="status" id="radio1" value="1">
                <label class="form-check-label text-dark" for="radio1"><b>Presentado</b></label>
              </div>
              <div class="custom-control custom-radio mb-2">
                <input class="form-check-input" type="radio" name="status" id="radio2" value="2">
                <label class="form-check-label text-dark" for="radio2"><b>Presupuesto Aprobado</b></label>
              </div>
              <div class="custom-control custom-radio mb-2">
                <input class="form-check-input" type="radio" name="status" id="radio4" value="4">
                <label class="form-check-label text-dark" for="radio4"><b>Vista Monitoreo</b></label>
              </div>
          </fieldset>

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal" id="btncancelar">Cancelar</button>
              <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
          </div>
        </form>

      </div>
    </div>
</div>