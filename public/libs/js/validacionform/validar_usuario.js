const d = document;
function edit(usuario_uuid){
    d.getElementById('form').onsubmit = function(e){
        e.preventDefault();
        if(!e.target.hasAttribute('data-form')){
            var array_roles = [];
            d.querySelectorAll('input[type=checkbox]:checked').forEach((el)=>{
                array_roles.push(el.value);
            });
            axios.put('/usuarios/'+ usuario_uuid,{
                password: d.getElementById('password').value,
                roles: array_roles, //enviamos los roles con checked
            })
            .then(function (resp){
                $("#modal").modal("hide");
                $('#usuarios').DataTable().ajax.reload();
            })
            .catch(function (error){
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
            })
        }
    }
}

function delet(usuario_uuid){
    d.getElementById('form_delete').onsubmit = function(e){
        e.preventDefault();
        //rescatamos el token del formulario de eliminar para enviarlo
        let datosform = $('#form_delete').serializeArray();
        $.ajax({
            url: "/usuarios/" + usuario_uuid,
            type: 'DELETE', 
            data: datosform,  
            success:function(respuesta)
            {
                //console.log(respuesta);
                $('#modal_delete').modal('hide');
                $('#usuarios').DataTable().ajax.reload(null, false);
            },
            error:function()
            {
                Swal.fire({
                    icon: 'error',
                    html: "No se pudo eliminar al Usuario",
                    width: '20%',
                    confirmButtonText: 'Aceptar',
                })
            }
        })
    };
}

//Initialize Select2 Elements
$('.select2').select2({
    // theme: 'bootstrap4',
});

d.addEventListener('click', (e)=>{
    if(e.target.matches('#nuevo') || e.target.matches('#nuevo *'))
    { 
        d.getElementById('trabajador_id').removeAttribute('disabled');
        d.getElementById('form').setAttribute('data-form', '');
        //quitamos los valores seleccionados del input multiple
        axios.get('/selectTrabajadores')
        .then(function (datos){
            let $options = '<option value="">seleccione...</option>';
            for(let i=0; i<datos.data.length; i++){
                $options += '<option value="'+datos.data[i].id+'">'+datos.data[i].documento+' - '+datos.data[i].nombre+'</option>';
            }
            d.getElementById('trabajador_id').innerHTML = $options;
        })
        .catch(function (error){

        })
        $("#form").trigger("reset");
        $("#modal .modal-title").text("Registrar Usuario"); 
        $("#modal").modal("show");

        //si cerramos el modal con errores al volver a abrirlo quitamos los errores anterires 
        $(document).find('span.error-text').text('');
        $(document).find('input.validacion').removeClass('is-invalid');
    }

    if(e.target.matches('[data-edit]') || e.target.matches('[data-edit] *'))
    {
        d.getElementById('form').reset(); //limpiamos el formulario
        d.getElementById('form').removeAttribute('data-form');
        //si cerramos el modal con errores al volver a abrirlo quitamos los errores anterires 
        $(document).find('span.error-text').text('');
        $(document).find('input.validacion').removeClass('is-invalid');
        //rescatamos la fila de datos del boton clickeado
        let data = $('#usuarios').DataTable().row($(e.target).parents('tr') ).data();
        //obtenemos el valor del token
        //let _token = document.querySelector('[name="_token"]').value;
        $option = `<option value="">${data.usuario} - ${data.nombre}</option>`;
        d.getElementById('trabajador_id').innerHTML = $option;
        d.getElementById('trabajador_id').setAttribute('disabled', true);
        d.getElementById('password').value = data.password;

        axios.get('/rolesUsuario/'+ data.uuid)
        .then(function (datos){
            // let roles=[] //para trabajar con select2 multiple
            // for(let i=0; i<datos.data.length; i++){
            //     // console.log('rol'+datos.data[i].role_id);
            //     roles.push(datos.data[i].role_id);
            //     $('#roles').val(roles).trigger('change');
            // }
            for(let i=0; i<datos.data.length; i++){
                // console.log('rol'+datos.data[i].role_id);
                d.querySelector('[data-role="rol'+datos.data[i].role_id+'"]').checked = true;
            }
        })
        .catch(function (error){
            // console.log('error'+error);
        })
        $("#modal .modal-title").text("Editar Usuario"); 
        $("#modal").modal("show");
    }

    if(e.target.matches('[data-delete]') || e.target.matches('[data-delete] *'))
    {
        let data = $('#usuarios').DataTable().row($(e.target).parents('tr') ).data();
        d.querySelector('.message').innerHTML = `${data.usuario} - ${data.nombre}`;
        $('#modal_delete').modal('show');
    }
})

d.addEventListener('submit', (e)=>{
    if(e.target.matches('#form'))
    {
        e.preventDefault();
        if(e.target.hasAttribute('data-form'))//si contiene el data-form significa que es una insercion
        {
            const datos = new FormData(e.target);
            axios.post('/usuarios', datos) //enviamos todos los input del form
            .then(function (response) {
                // console.log(response);
                $("#modal").modal("hide");
                $('#usuarios').DataTable().ajax.reload(null, false);
            })
            .catch(function (error) {
                // console.log(error.response.data.errors);
                const objeto = error.response.data.errors; //creamos el objeto para luego recorrerlo
                if (error.response.data.hasOwnProperty('errors')) //preguntamos si exite la propiedad donde se almacenan los errores false/true
                {
                    for (let key in  objeto) 
                    {   //key: llave    objeto[key]: valor respuesta
                        // console.log(key);
                        d.getElementById(key).classList.add('is-invalid');
                        d.getElementById(key+'-error').textContent = objeto[key];
                    }
                }
            });
        }
    }
})