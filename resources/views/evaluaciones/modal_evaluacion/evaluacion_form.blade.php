<div class="modal fade animado" id="modal_evaluacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title text-dark" id="exampleModalLabel"></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>

       <form action="" method="" id="form-operacion" class="">
         @csrf
         <input type="hidden" id="corto_plazo_accion_id" name="id_corto_plazo_accion">
         <input type="hidden" name="id_operacion" id="id_operacion">
         <div class="modal-body">
           <div class="row">
             <div class="col-md-12">
               <div class="form-group">
                 <div>
                    <p><b>Accion corto plazo:</b> {!!$corto_plazo_accion->accion_corto_plazo!!}</p>
                    <p><b>Presupuesto Aprobado:</b> {!!number_format($corto_plazo_accion->presupuesto_programado)!!} Bs.</p>
                  </div>
                 <hr>
                 <div><b>Resultado esperado <span class="bg-light p-1">{{$trimestre}}</span>:</b> {{$resultado_esperado}}</div>
                 <hr>
                 <div>
                  <label class="col-form-label"><b>Resultado logrado {{$trimestre}}<span class="text-danger"> *</span></b></label>
                  <input class="form-control" data-error="input" name="{{$trimestre}}" id="{{$trimestre}}" placeholder="resultado esperado...">
                  <span class="text-danger error-text" data-error="span" id="nombre_operacion-error"></span>
                 </div>
                 <div>
                  <label class="col-form-label"><b>Presupuesto ejecutado {{$trimestre}}<span class="text-danger"> *</span></b></label>
                  <input class="form-control" data-error="input" name="{{$trimestre}}" id="{{$trimestre}}" placeholder="presupuesto ejecutado...">
                  <span class="text-danger error-text" data-error="span" id="nombre_operacion-error"></span>
                 </div>
               </div>
               </div>
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