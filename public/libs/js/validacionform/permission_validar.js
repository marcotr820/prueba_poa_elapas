const d = document;
d.addEventListener('click', (e)=>{
   if(e.target.matches('#nuevo_permission') || e.target.matches('#nuevo_permission *')){
      d.getElementById('form').reset();
      $('#modal').modal('show');
      d.querySelector('.modal-title').textContent = 'Registrar Permiso';
   }

   if(e.target.matches('[data-edit]') || e.target.matches('[data-edit] *')){
      d.querySelector('.modal-title').textContent = 'Editar Permiso';
      let data = $('#permisos').DataTable().row($(e.target).parents('tr') ).data();
      d.getElementById('name').value = data.name;
      $('#modal').modal('show');
   }

   if(e.target.matches('[data-delete]') || e.target.matches('[data-delete]')){
      e.preventDefault();
      let data = $('#permisos').DataTable().row($(e.target).parents('tr') ).data();
      d.querySelector('.message').textContent = data.name;
      $('#modal_delete').modal('show');
   }
})