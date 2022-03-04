const d = document;
function edit(operacion_uuid){
	d.getElementById('form').onsubmit = function(e){
		if(! e.target.hasAttribute('data-form')){
			e.preventDefault();
			axios.put('/operaciones/'+operacion_uuid, {
				nombre_operacion: d.getElementById('nombre_operacion').value
			})
			.then(function (response) {
				//console.log(response);
				$('#modal').modal('hide');
				$('#operaciones').DataTable().ajax.reload(null, false);
			})
			.catch(function (error) {
				//console.log(error.response.data.errors);
				let objeto = error.response.data.errors; //creamos el objeto para luego recorrerlo
				if (error.response.data.hasOwnProperty('errors')) //preguntamos si exite la propiedad donde se almacenan los errores false/true
				{
					for (let key in  objeto) 
					{
						//console.log(key);
						//console.log(errores[key]);
						//key nombre del campo ej. nombre_operacion
						//errores[key] valor ej. "El campo nombre operacion es obligatorio."
						d.getElementById(key).classList.add('is-invalid');
						d.getElementById(key+'-error').textContent = objeto[key];
					}
				}
			});
		}
	}
}

function delet(operacion_uuid){
	d.getElementById('form_delete').onsubmit = function(e){
		e.preventDefault();
		axios.delete('/operaciones/' + operacion_uuid)
		.then(function (response) {
			//console.log(response);
			$('#modal_delete').modal('hide');
			$('#operaciones').DataTable().ajax.reload(null, false);
			toast_success('Se Elimino el registro');
		})
		.catch(function (error) {

		});
	}
}
// evento click
d.addEventListener('click', (e) => {
	if(e.target.matches('[data-actividades]')){
		let data = $('#operaciones').DataTable().row($(e.target).parents('tr') ).data();
		location.href='/operaciones/' +data.uuid+ '/actividades' ;
	}

    if (e.target.matches('#nuevo') || e.target.matches('#nuevo *')) //matches busca un selector valido y responde true o false
    {
    	d.querySelector('#modal .modal-title').textContent = "Nueva Operacion";
		d.getElementById('form').setAttribute('data-form', '');
    	d.getElementById('form').reset(); //limpiar inputs formulario al abrirlo
    	d.querySelectorAll('[data-error="input"]').forEach( (el) => { el.classList.remove('is-invalid') }); //limpiamos el input del error
    	d.querySelectorAll('[data-error="span"]').forEach( (el) => { el.textContent = '' }); //limpiamos el span del error
      	$('#modal').modal('show');
    }

	if(e.target.matches('[data-edit]') || e.target.matches('[data-edit] *')){
		d.getElementById('form').removeAttribute('data-form');
		d.querySelectorAll('[data-error="input"]').forEach(el => { el.classList.remove('is-invalid') }); //limpiamos el input del error
		d.querySelectorAll('[data-error="span"]').forEach(el => { el.textContent = '' }); //limpiamos el span del error
		d.querySelector('.modal-title').textContent = 'Editar';
		let data = $('#operaciones').DataTable().row($(e.target).parents('tr') ).data();
		d.getElementById('nombre_operacion').value = data['nombre_operacion'];
		$("#modal").modal("show");
	}

	if(e.target.matches('[data-delete]') || e.target.matches('[data-delete] *')){
		let data = $('#operaciones').DataTable().row($(e.target).parents('tr') ).data();
		d.querySelector('.message').innerHTML = data.nombre_operacion;
		$('#modal_delete').modal('show');
	}
});

// evento submit
d.addEventListener('submit', (e) =>{
	e.preventDefault();
	if (e.target.matches('#form')) //solo ejecutamos la peticion si el evento lo ejecuta el formulario
	{
		d.querySelectorAll('[data-error="span"]').forEach( (el) => { el.textContent = '' });
		d.querySelectorAll('[data-error="input"]').forEach( (el) => { el.classList.remove('is-invalid') });
		if (e.target.hasAttribute('data-form'))
		{	//POST
			const datos = new FormData(e.target);
			axios.post('/operaciones/'+accion_corto_uuid, datos)
			.then(function (response) {
				// console.log(response);
				$('#modal').modal('hide');
				$('#operaciones').DataTable().ajax.reload(null, false);
			})
			.catch(function (error) {
				console.log(error.response.data.errors);
				let objeto = error.response.data.errors; //creamos el objeto para luego recorrerlo
				if (error.response.data.hasOwnProperty('errors')) //preguntamos si exite la propiedad donde se almacenan los errores false/true
				{
					for (let key in  objeto) 
					{
						//console.log(key);
						//console.log(errores[key]);
						//key nombre del campo ej. nombre_operacion
						//errores[key] valor ej. "El campo nombre operacion es obligatorio."
						d.getElementById(key).classList.add('is-invalid');
						d.getElementById(key+'-error').textContent = objeto[key];
					}
				}
			});
		}
		else
		{	//PUT
			
		}
	}
});

//=================EVENTO ELIMINAR==================
$(document).on( 'click', '[data-delete]', function (e) {
	e.preventDefault();
    // let id_operacion = data['id'];


} );
