const d = document;
function edit(role_id){
   d.getElementById('form').onsubmit = function(e){
      if(! e.target.hasAttribute('data-form')){
         d.querySelectorAll('[data-error="input"]').forEach((el)=>{ el.classList.remove('is-invalid') });
         d.querySelectorAll('[data-error="span"]').forEach((el)=>{ el.textContent = '' });
         let update_permisos = [];
         let checkboxs = d.querySelectorAll('[data-permiso]'); //almacenamos todos los checkbox
         checkboxs.forEach((el)=>{
            if(el.checked){ //preguntamos si el checkbox esta checked
               update_permisos.push(el.value); //lo añadimos al array su valor id
            }
         })
         axios.put('/roles/' + role_id,{
            nombre_rol: d.getElementById('nombre_rol').value,
            permisos: update_permisos,
         }) //enviamos todos los input del form
         .then(function (response) {
            // console.log(response);
            $("#modal").modal("hide");
            $('#roles').DataTable().ajax.reload(null, false);
         })
         .catch(function (error) {
            // console.log(error.response.data.errors);
            const objeto = error.response.data.errors; //creamos el objeto para luego recorrerlo
            if (error.response.data.hasOwnProperty('errors')) //preguntamos si exite la propiedad donde se almacenan los errores false/true
            {
               for (let key in  objeto) 
               {   //key: llave    objeto[key]: valor respuesta
                  d.getElementById(key).classList.add('is-invalid');
                  d.getElementById(key+'-error').textContent = objeto[key];
               }
            }
         });
      }
   }
}
function delet(role_id){
   d.getElementById('form_delete').onsubmit = function(e){
      e.preventDefault();
      axios.delete('/roles/'+ role_id)
      .then(function (response) {
         $("#modal_delete").modal("hide");
         $('#roles').DataTable().ajax.reload(null, false);
      })
      .catch(function (error) {

      });
   }
}
d.addEventListener('click', (e)=>{
   if(e.target.matches('#nuevo_rol') || e.target.matches('#nuevo_rol *'))
   {
      d.querySelectorAll('[data-error="input"]').forEach((el)=>{ el.classList.remove('is-invalid') });
      d.querySelectorAll('[data-error="span"]').forEach((el)=>{ el.textContent = '' });
      d.getElementById('form').reset(); //limpiamos el formulario
      $('#modal').modal('show');
      d.getElementById('form').setAttribute('data-form', '');
      d.querySelector('#modal .modal-title').textContent = 'Registrar Rol';
   }

   if(e.target.matches('[data-edit]') || e.target.matches('[data-edit] *'))
   {
      d.querySelectorAll('[data-error="input"]').forEach((el)=>{ el.classList.remove('is-invalid') });
      d.querySelectorAll('[data-error="span"]').forEach((el)=>{ el.textContent = '' });
      d.getElementById('form').reset(); //limpiamos el formulario
      let data = $('#roles').DataTable().row($(e.target).parents('tr') ).data();
      axios.get('/permisos_rol/' + data.id)
      .then(function (response) {
         for(let i=0; i < response.data.length; i++){
            d.querySelector('[data-permiso="permiso'+response.data[i].permission_id+'"]').checked = true;
         }
      })
      .catch(function (error) {
         console.log(error);
      });
      d.getElementById('nombre_rol').value = data.name;
      d.querySelector('#modal .modal-title').textContent = 'Editar Rol';
      d.getElementById('form').removeAttribute('data-form');
      $('#modal').modal('show');
   }

   if(e.target.matches('[data-delete]') || e.target.matches('[data-delete] *'))
   {
      let data = $('#roles').DataTable().row($(e.target).parents('tr') ).data();
      d.querySelector('.message').innerHTML = data.name;
      $('#modal_delete').modal('show');
   }
});

d.addEventListener('submit', (e)=>{
   if(e.target.matches('form')){
      e.preventDefault();
      if(e.target.hasAttribute('data-form'))
      {
         d.querySelectorAll('[data-error="input"]').forEach((el)=>{ el.classList.remove('is-invalid') });
         d.querySelectorAll('[data-error="span"]').forEach((el)=>{ el.textContent = '' });
         let datos = new FormData(e.target);
         axios.post('/roles', datos) //enviamos todos los input del form
         .then(function (response) {
            // console.log(response);
            $("#modal").modal("hide");
            $('#roles').DataTable().ajax.reload(null, false);
         })
         .catch(function (error) {
            // console.log(error.response.data.errors);
            const objeto = error.response.data.errors; //creamos el objeto para luego recorrerlo
            if (error.response.data.hasOwnProperty('errors')) //preguntamos si exite la propiedad donde se almacenan los errores false/true
            {
               for (let key in  objeto) 
               {   //key: llave    objeto[key]: valor respuesta
                  d.getElementById(key).classList.add('is-invalid');
                  d.getElementById(key+'-error').textContent = objeto[key];
               }
            }
         });
      }
   }
});