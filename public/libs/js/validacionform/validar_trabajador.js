const d = document;
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "200",
  "hideDuration": "1000",
  "timeOut": "1000"
}
function edit(trabajador_uuid){
   d.getElementById('form').onsubmit = function(e){
      if(! e.target.hasAttribute('data-form')){
         d.querySelector('.spinner-border').style.display = 'inline-block';
         d.getElementById('btnGuardar').setAttribute('disabled', true);
         axios.put('/trabajadores/'+ trabajador_uuid,{
            documento: d.getElementById('documento').value,
            unidad_id: d.getElementById('unidad_id').value,
            nombre: d.getElementById('nombre').value,
            cargo: d.getElementById('cargo').value,
         })
         .then(function (resp){
            $('#modal').modal('hide');
            $('#trabajadores').DataTable().ajax.reload(null, false);
         })
         .catch(function (error){
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
   };
}

function delet(trabajador_uuid){
   d.getElementById('form_delete').onsubmit = function(e){
      e.preventDefault();
      axios.delete('/trabajadores/'+ trabajador_uuid)
      .then(function (resp){
         $('#modal_delete').modal('hide');
         $('#trabajadores').DataTable().ajax.reload(null, false);
      })
      .catch(function (error){

      })
   };
}

$(document).on( 'click', function(e) {
   if(e.target.matches('#nuevo') || e.target.matches('#nuevo *'))
   {
      d.querySelector('.spinner-border').style.display = 'none';
      d.getElementById('btnGuardar').removeAttribute('disabled');
      d.getElementById('form').reset();
      d.querySelector('.modal-title').textContent = 'Registrar Trabajador';
      d.querySelectorAll('[data-error="input"]').forEach( (el) => { el.classList.remove('is-invalid') }); //limpiamos el input del error
      d.querySelectorAll('[data-error="select"]').forEach( (el) => { el.classList.remove('is-invalid') }); //limpiamos el select del error
      d.querySelectorAll('[data-error="span"]').forEach( (el) => { el.textContent = '' }); //limpiamos el span del error
      d.getElementById('form').setAttribute('data-form', '');
      $('#modal').modal('show');
   }

   if(e.target.matches('[data-edit]') || e.target.matches('[data-edit] *'))
   {
      d.querySelector('.spinner-border').style.display = 'none';
      d.getElementById('btnGuardar').removeAttribute('disabled');
      d.getElementById('form').reset();
      d.querySelectorAll('[data-error="input"]').forEach( (el) => { el.classList.remove('is-invalid') }); //limpiamos el input del error
      d.querySelectorAll('[data-error="select"]').forEach( (el) => { el.classList.remove('is-invalid') }); //limpiamos el select del error
      d.querySelectorAll('[data-error="span"]').forEach( (el) => { el.textContent = '' }); //limpiamos el span del error
      // const data = tabla_trabajadores.row($(e.target).parents('tr') ).data();
      const data = $("#trabajadores").DataTable().row($(e.target).parents('tr') ).data();
      d.querySelector('.modal-title').textContent = 'Editar Trabajador';
      d.getElementById('documento').value = data.documento;
      d.getElementById('unidad_id').value = data.unidad_id;
      d.getElementById('nombre').value = data.nombre;
      d.getElementById('cargo').value = data.cargo;
      d.getElementById('form').removeAttribute('data-form');
      $('#modal').modal('show');
   }

   if(e.target.matches('[data-delete]') || e.target.matches('[data-delete] *'))
   {
    const data = $("#trabajadores").DataTable().row($(e.target).parents('tr') ).data();
    const nombre = data.nombre;
    d.querySelector('.message').innerHTML = nombre;
    $('#modal_delete').modal('show');
   }

});

d.addEventListener('submit', (e)=>{
   if(e.target.matches('#form'))
   {
      e.preventDefault();
      if(e.target.hasAttribute('data-form')) //si contiene el data-form significa que es una insercion
      {  //POST
         d.querySelector('.spinner-border').style.display = 'inline-block';
         d.getElementById('btnGuardar').setAttribute('disabled', true);
         const datos = new FormData(e.target);
         axios.post('/trabajadores', datos) //enviamos todos los input del form
         .then(function (response) {
            // console.log(response);
            $("#trabajadores").DataTable().ajax.reload(null, false);
            $('#modal').modal('hide');
            toastr["success"]("My name is Inigo Montoya. You killed my father. Prepare to die!");
         })
         .catch(function (error) {
            d.querySelector('.spinner-border').style.display = 'none';
            d.getElementById('btnGuardar').removeAttribute('disabled');
            // console.log(error.response.data.errors);
            const objeto = error.response.data.errors; //creamos el objeto para luego recorrerlo
            if (error.response.data.hasOwnProperty('errors')) //preguntamos si exite la propiedad donde se almacenan los errores false/true
            {
               for (let key in  objeto) 
               {
                  //key: llave    objeto[key]: valor respuesta
                  d.getElementById(key).classList.add('is-invalid');
                  d.getElementById(key+'-error').textContent = objeto[key];
               }
            }
         });
      }
   }

});