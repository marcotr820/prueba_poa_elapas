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
           <div class="form-group">
             <label for="" class="col-form-label"><b>Nombre Tarea Especifica <span class="text-danger">*</span></b></label>
             <input type="text" id="nombre_tarea" name="nombre_tarea" data-error="input" class="form-control" autocomplete="off">
             <span class="text-danger error-text" data-error="span" id="nombre_tarea-error"></span>
           </div>
           <div class="form-group">
             <label for="" class="col-form-label"><b>Resultado Esperado <span class="text-danger">*</span></b></label>
             <input type="text" id="resultado_esperado" name="resultado_esperado" data-error="input" class="form-control" autocomplete="off">
             <span class="text-danger error-text" data-error="span" id="resultado_esperado-error"></span>
           </div>
         </div>
         <div class="modal-footer">
          <button class="btn btn-primary">Guardar</button>
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