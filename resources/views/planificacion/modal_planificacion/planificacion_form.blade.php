<div class="modal fade animado" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title text-dark" id="exampleModalLabel"></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>

       <form action="" method="" id="form_planificacion">
         @csrf
         <div class="modal-body">
           <div class="row">
              <div class="col-md-12">
                <div class="alert alert-danger m-0" role="alert">
                  los campos deben sumar el 100%
                </div>

                <div class="form-group" id="lista">
                  @foreach ($trimestres as $trimestre)
                  <div class="form-group">
                    <label class="col-form-label"><b>{{$trimestre}}:</b></label>
                    <input class="form-control" data-error="input" name="{{$trimestre}}" id="{{$trimestre}}" placeholder="planificado...">
                    <span class="text-danger error-text" data-error="span" id="{{$trimestre}}-error"></span>
                  </div>
                  @endforeach
                </div>
              </div>
           </div>
         </div>

         <div class="modal-footer">
           <button type="button" class="btn btn-light" data-dismiss="modal" id="btncancelar">Cancelar</button>
           <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
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
            ¿Esta seguro de eliminar a <b><span class="message bg-light text-danger p-1"></span></b> ? ¡Una vez eliminado, se perderá para siempre!
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