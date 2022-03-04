const d = document;
d.querySelector('.alert').style.display = 'none';

function delet(planificacion_uuid){
   d.getElementById('form_delete').onsubmit = function(e){
      e.preventDefault();
         axios.delete('/planificacion/' + planificacion_uuid)
         .then(function (response) {
            console.log(response.data);
            $('#modal_delete').modal('hide');
            $('#planificacion').DataTable().ajax.reload(null, false);
            d.getElementById('nuevo').style.display = 'inline';
         })
         .catch(function (error) {

         });
   }
}

d.addEventListener('click', (e)=>{
   if(e.target.matches('#nuevo'))
   {
      d.getElementById('form_planificacion').reset();
      d.querySelector('.modal-title').textContent = 'Registrar Planificacion';
      d.getElementById('form_planificacion').setAttribute('data-form', '');
      $('#modal').modal('show');
   }

   if(e.target.matches('[data-delete]') || e.target.matches('[data-delete] *'))
   {
      e.preventDefault();
      const data = $('#planificacion').DataTable().row($(e.target).parents('tr') ).data();
      d.querySelector('.message').innerHTML = 'planificacion';
      $('#modal_delete').modal('show');
   }
});

d.addEventListener('submit', (e)=>{
   if(e.target.matches('#form_planificacion'))
   {
      e.preventDefault();
      if(e.target.hasAttribute('data-form'))
      {
         const lista = d.querySelectorAll('#lista input');
         var bb = 0;
         lista.forEach((el)=>{
             bb += parseInt(el.value); //sumamos todos los campos para que den un valor de 100
         })
         // console.log(bb);
         if(bb != 100)
         {
            d.querySelector('.alert').style.display = 'block';
            setTimeout( () =>{
               d.querySelector('.alert').style.display = 'none';
           }, 2500);
         }
         else
         {
            const datos = new FormData(e.target);
            axios.post('/planificacion/'+ corto_plazo_uuid, datos) //enviamos todos los input del form
            .then(function (response) {
               // console.log(response);
               d.getElementById('nuevo').style.display = 'none';
               $('#planificacion').DataTable().ajax.reload(null, false);
               $('#modal').modal('hide');
            })
            .catch(function (error) {
               // console.log(error.response.data.errors);
               const objeto = error.response.data.errors; //creamos el objeto para luego recorrerlo
               if (error.response.data.hasOwnProperty('errors')) //preguntamos si exite la propiedad donde se almacenan los errores false/true
               {
                   for (let key in  objeto) 
                   {
                       //console.log(key);
                       //console.log(errores[key]);
                       //key nombre del campo ej. nombre_operacion
                       //objeto[key] valor ej. "El campo nombre operacion es obligatorio. SU VALOR"
                       d.getElementById(key).classList.add('is-invalid');
                       d.getElementById(key+'-error').textContent = objeto[key];
                   }
               }
            });
         }
      }
   }
});