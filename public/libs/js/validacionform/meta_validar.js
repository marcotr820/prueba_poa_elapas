const d = document;
toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "200",
    "hideDuration": "1000",
    "timeOut": "1700"
}
function edit(meta_uuid){
    d.getElementById('form').onsubmit = function(e){
        if(! e.target.hasAttribute('data-form')){
            d.querySelector('.spinner-border').style.display = 'inline-block';
            d.getElementById('btnGuardar').setAttribute('disabled', true);
            $(document).find('[data-error="span"]').text('');
            $(document).find('[data-error="textarea"]').removeClass('is-invalid');
            axios.put('/metas/'+ meta_uuid,{
                nombre_meta: d.getElementById('nombre_meta').value,
            })
            .then(function (resp){
                $('#modal').modal('hide');
                $('#metas').DataTable().ajax.reload(); // tabla_actividades.ajax.reload(null, false);
            })
            .catch(function (error){
                d.querySelector('.spinner-border').style.display = 'none';
                d.getElementById('btnGuardar').removeAttribute('disabled');
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

function delet(meta_uuid){
    d.getElementById('form_delete').onsubmit = function(e){
        e.preventDefault();
        axios.delete('/metas/'+ meta_uuid)
        .then(function (resp){
            $('#modal_delete').modal('hide');
            $('#metas').DataTable().ajax.reload();
        })
        .catch(function (error){
        })
    }
}

d.addEventListener('click', (e)=>{
    if(e.target.matches('[data-resultados]'))
    {
        let data = $('#metas').DataTable().row($(e.target).parents('tr') ).data();
        location.href='/metas/'+data.uuid+'/resultados';
    }

    if(e.target.matches('#nuevo'))
    {
        d.querySelector('.spinner-border').style.display = 'none';
        d.getElementById('btnGuardar').removeAttribute('disabled');
        $("#form").trigger("reset");
        $("#modal .modal-title").text("Nuevo"); 
        $("#modal").modal("show");
        d.getElementById('form').setAttribute('data-form', '');
        //si cerramos el modal con errores al volver a abrirlo quitamos los errores anterires llamando a sus clases de cada elemento
        $(document).find('[data-error="span"]').text('');
        $(document).find('[data-error="textarea"]').removeClass('is-invalid');
    }

    if(e.target.matches('[data-edit]') || e.target.matches('[data-edit] *'))
    {
        d.querySelector('.spinner-border').style.display = 'none';
        d.getElementById('btnGuardar').removeAttribute('disabled');
        d.getElementById('form').removeAttribute('data-form');
        $(document).find('[data-error="span"]').text('');
        $(document).find('[data-error="textarea"]').removeClass('is-invalid');
        // let data = tabla_metas.row($(this).parents('tr') ).data();
        let data = $('#metas').DataTable().row($(e.target).parents('tr') ).data();
        $("#nombre_meta").val(data.nombre_meta);
        $("#modal .modal-title").text("Editar"); 
        $("#modal").modal("show");
    }

    if(e.target.matches('[data-delete]') || e.target.matches('[data-delete] *'))
    {
        e.preventDefault();
        // let data = tabla_metas.row($(this).parents('tr') ).data();
        let data = $('#metas').DataTable().row($(e.target).parents('tr') ).data();
        let nombre_meta = data['nombre_meta'];
        $("#modal_delete").modal("show");
        d.querySelector('.message').innerHTML = nombre_meta;
    }
})

// envio de formulario
d.addEventListener('submit', (e)=>{
    if(e.target.matches('#form'))
    {
        e.preventDefault();
        if(e.target.hasAttribute('data-form'))
        {
            d.querySelector('.spinner-border').style.display = 'inline-block';
            d.getElementById('btnGuardar').setAttribute('disabled', true);
            $(document).find('[data-error="span"]').text('');
            $(document).find('[data-error="textarea"]').removeClass('is-invalid');
            const datos = new FormData(e.target);
            axios.post('/metas/'+ pilar_uuid, datos) //enviamos todos los input del form
        	.then(function (response) {
                // console.log(response);
                $('#metas').DataTable().ajax.reload(null, false);
                $('#modal').modal('hide');
                toastr["success"]("Accion realizada con exito");
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
                        d.getElementById(key).classList.add('is-invalid');
                        d.getElementById(key+'-error').textContent = objeto[key];
                    }
                }
            });
        }
    }
})