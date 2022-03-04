const d = document;

d.addEventListener('click', (e)=>{
   if(e.target.matches('#nuevo') || e.target.matches('#nuevo *'))
   {
      d.getElementById('form_partida').reset();
      d.querySelector('.modal-title').textContent = 'Nueva Partida';
      d.getElementById('form_partida').setAttribute('data-form', '');
      d.querySelectorAll('[data-error="input"]').forEach( (el) => { el.classList.remove('is-invalid') }); //limpiamos el input del error
      d.querySelectorAll('[data-error="select"]').forEach( (el) => { el.classList.remove('is-invalid') }); //limpiamos el select del error
    	d.querySelectorAll('[data-error="span"]').forEach( (el) => { el.textContent = '' }); //limpiamos el span del error
      $('#modal_partida').modal('show');
   }

   if(e.target.matches('[data-edit]'))
   {
      const data =  $('#partidas').DataTable().row($(e.target).parents('tr') ).data();
      d.querySelector('.modal-title').textContent = 'Editar Partida';
      d.getElementById('nombre_partida').value = data['nombre_partida'];
      d.getElementById('codigo_partida').value = data['codigo_partida'];
      d.getElementById('tipo_partida').value = data['tipo_partida'];
      d.getElementById('form_partida').removeAttribute('data-form');
      d.querySelectorAll('[data-error="input"]').forEach( (el) => { el.classList.remove('is-invalid') }); //limpiamos el input del error
      d.querySelectorAll('[data-error="select"]').forEach( (el) => { el.classList.remove('is-invalid') }); //limpiamos el select del error
    	d.querySelectorAll('[data-error="span"]').forEach( (el) => { el.textContent = '' }); //limpiamos el span del error
      id_partida = data['id'];
      $('#modal_partida').modal('show');
   }

   if(e.target.matches('[data-delete]'))
   {
      e.preventDefault();
      const data = $('#partidas').DataTable().row($(e.target).parents('tr') ).data();
      const nombre_partida = data['nombre_partida'];
      const id_partida = data['id'];
      Swal.fire({
			html: "Desea Eliminar el Registro : <br> <u><b>"+nombre_partida+"</b></u>",
			width: '20%',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			confirmButtonText: 'Si eliminar',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.isConfirmed) 
			{
				axios.delete('/partidas/' + id_partida)
				.then(function (response) {
					$('#partidas').DataTable().ajax.reload(null, false);
					toast_success('Se Elimino el registro');
				})
				.catch(function (error) {
					toast_error('Error al realizar la accion');
				});
			}
		})
   }
   
});

d.addEventListener('submit', (e)=>{
   e.preventDefault();
   if(e.target.matches('#form_partida'))
   {
      if(e.target.matches('[data-form]'))
      {
         const datos = new FormData(e.target);
         axios.post('/partidas', datos) //enviamos todos los input del form
         .then(function (response) {
            $('#partidas').DataTable().ajax.reload(null, false);
            $('#modal_partida').modal('hide');
            toast_success('Se Agrego el registro');
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
      else
      {
         axios.put('/partidas/'+ id_partida, {
            nombre_partida: d.getElementById('nombre_partida').value,
            codigo_partida: d.getElementById('codigo_partida').value,
            tipo_partida: d.getElementById('tipo_partida').value
         }) //enviamos todos los input del form
         .then(function (response) {
            $('#partidas').DataTable().ajax.reload(null, false);
            $('#modal_partida').modal('hide');
            toast_success('Se Agrego el registro');
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