const d = document;
function edit(tarea_uuid){
d.getElementById('form').onsubmit = function (e){
   if(! e.target.hasAttribute('data-form')){
      e.preventDefault();
      d.querySelectorAll('[data-error="input"]').forEach((el)=>{ el.classList.remove('is-invalid') });
      d.querySelectorAll('[data-error="span"]').forEach((el)=>{ el.textContent = '' });
      axios.put('/tareas_especificas/'+ tarea_uuid, {
      nombre_tarea: d.getElementById('nombre_tarea').value,
      resultado_esperado: d.getElementById('resultado_esperado').value
      })   
      .then(function (resp){
         $('#modal').modal('hide');
         $('#tareas_especificas').DataTable().ajax.reload();
      })
      .catch(function (error){
         // console.log(error.response.data.errors);
         const objeto = error.response.data.errors; //creamos el objeto para luego recorrerlo
         if (error.response.data.hasOwnProperty('errors')) //preguntamos si exite la propiedad donde se almacenan los errores false/true
         {
            for (let key in  objeto) 
            {
               d.getElementById(key).classList.add('is-invalid');
               d.getElementById(key+'-error').textContent = objeto[key];
            }
         }
      })
   }
}
}

function delet(tarea_uuid){
   d.getElementById('form_delete').onsubmit = function (e){
      e.preventDefault();
      axios.delete('/tareas_especificas/'+ tarea_uuid)
      .then(function (resp){
         $('#modal_delete').modal('hide');
         $('#tareas_especificas').DataTable().ajax.reload();
      })
      .catch(function (error){
      })
   }
}

$(document).on( 'click', function(e) {

   if(e.target.matches('#nuevo') || e.target.matches('#nuevo *'))
   {
      d.querySelectorAll('[data-error="input"]').forEach((el)=>{ el.classList.remove('is-invalid') });
      d.querySelectorAll('[data-error="span"]').forEach((el)=>{ el.textContent = '' });
      d.getElementById('form').reset();
      d.querySelector('.modal-title').textContent = 'Nuevo';
      d.getElementById('form').setAttribute('data-form', '');
      $('#modal').modal('show');
   }

   if(e.target.matches('[data-edit]') || e.target.matches('[data-edit] *'))
   {
      d.querySelectorAll('[data-error="input"]').forEach((el)=>{ el.classList.remove('is-invalid') });
      d.querySelectorAll('[data-error="span"]').forEach((el)=>{ el.textContent = '' });
      const data = $('#tareas_especificas').DataTable().row($(e.target).parents('tr') ).data();
      d.querySelector('.modal-title').textContent = 'Editar';
      d.getElementById('nombre_tarea').value = data['nombre_tarea'];
      d.getElementById('resultado_esperado').value = data['resultado_esperado'];
      d.getElementById('form').removeAttribute('data-form');
      $('#modal').modal('show');
   }

   if(e.target.matches('[data-delete]') || e.target.matches('[data-delete] *'))
   {
      let data = $('#tareas_especificas').DataTable().row($(e.target).parents('tr') ).data();
      d.querySelector('.message').innerHTML = data.nombre_tarea;
      $('#modal_delete').modal('show');
   }

});

d.addEventListener('submit', (e)=>{
   if(e.target.matches('#form'))
   {
      e.preventDefault();
      if(e.target.hasAttribute('data-form'))
      {  //POST
         d.querySelectorAll('[data-error="input"]').forEach((el)=>{ el.classList.remove('is-invalid') });
         d.querySelectorAll('[data-error="span"]').forEach((el)=>{ el.textContent = '' });
         const datos = new FormData(e.target);
         axios.post('/tareas_especificas/'+ actividad_uuid, datos) //enviamos todos los input del form
        	.then(function (response) {
        	   // console.log(response);
            $('#tareas_especificas').DataTable().ajax.reload(null, false);
            $('#modal').modal('hide');
         })
         .catch(function (error) {
               // console.log(error.response.data.errors);
               const objeto = error.response.data.errors; //creamos el objeto para luego recorrerlo
               if (error.response.data.hasOwnProperty('errors')) //preguntamos si exite la propiedad donde se almacenan los errores false/true
               {
                  for (let key in  objeto) 
                  {
                     d.getElementById(key).classList.add('is-invalid');
                     d.getElementById(key+'-error').textContent = objeto[key];
                  }
               }
         });
      }
   }
});