<div class="modal fade animado" id="modal" tabindex="" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
               <label for="" class="col-form-label"><b>Item o Servicio <span class="text-danger">*</span></b></label>
               <input type="text" id="bien_servicio" name="bien_servicio" data-error="input" class="form-control" autocomplete="off">
               <span class="text-danger" data-error="span" id="bien_servicio-error"></span>
            </div>

            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for=""><b>Fecha Requerida <span class="text-danger">*</span></b></label>
                     <input type="date" class="form-control" data-error="input" name="fecha_requerida" id="fecha_requerida">
                     <span class="text-danger" data-error="span" id="fecha_requerida-error"></span>
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="form-group">
                     <label for=""><b>Presupuesto <span class="text-danger">*</span></b></label>
                     <input type="text" data-error="input" class="form-control" name="presupuesto" id="presupuesto">
                     <span class="text-danger" data-error="span" id="presupuesto-error"></span>
                  </div>
               </div>
            </div> 

            <div class="form-group">
               <label for=""><b>Partida <span class="text-danger">*</span></b></label>
               <select class="form-control select2" name="partida_id" data-error="select" id="partida_id" style="width:100%;">
                  <option value="">Seleccione...</option>
                  @foreach ($partidas as $partida)
                  <option value="{{$partida->id}}">{{$partida->nombre_partida}}</option>
                  @endforeach
               </select>
               <span class="text-danger" data-error="span" id="partida_id-error"></span>
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