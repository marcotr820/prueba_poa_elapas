<div class="modal fade animado" id="modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <label for=""><b>Nombre Rol <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" data-error="input" id="nombre_rol" name="nombre_rol" placeholder="ingrese el nombre del rol">
            <span class="text-danger" data-error="span" id="nombre_rol-error"></span>
          </div>

          <div class="form-group">
            <label for=""><b>Lista Permisos <span class="text-danger">*</span></b></label>
            @foreach ($permisos as $permiso)
              <div>
                <label>
                  <input type="checkbox" class="mr-1" name="permisos[]" value="{{$permiso->id}}" data-permiso="permiso{{$permiso->id}}">
                  <b>{{$permiso->name}}</b>
                </label>
              </div>
            @endforeach
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