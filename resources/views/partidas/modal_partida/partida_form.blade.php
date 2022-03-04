<div class="modal fade animado" id="modal_partida" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel"></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>

       <form action="" method="POST" id="form_partida">  
         @csrf
         <div class="modal-body">
           <div class="form-group">
             <label for="" class="col-form-label"><b>Nombre Partida: <span class="text-danger">*</span></b></label>
             <input type="text" id="nombre_partida" name="nombre_partida" data-error="input" class="form-control" autocomplete="off">
             <span class="text-danger" data-error="span" id="nombre_partida-error"></span>
           </div>

           <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                  <label for=""><b>Codigo Partida: <span class="text-danger">*</span></b></label>
                  <input type="text" id="codigo_partida" name="codigo_partida" data-error="input" class="form-control" autocomplete="off">
                  <span class="text-danger" data-error="span" id="codigo_partida-error"></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for=""><b>Tipo Partida: <span class="text-danger">*</span></b></label>
                    <select id="tipo_partida" name="tipo_partida" data-error="select" class="form-control custom-select">
                      <option value="">Seleccione...</option>
                      <option value="funcionamiento">funcionamiento</option>
                      <option value="inversion">inversion</option>
                    </select>
                    <span class="text-danger" data-error="span" id="tipo_partida-error"></span>
                </div>
            </div>
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