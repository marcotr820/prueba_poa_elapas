const d = document;
function edit(mediano_plazo_accion_uuid){
    d.getElementById('form').onsubmit = function(e){
        if(! e.target.hasAttribute('data-form')){
            e.preventDefault();
            d.querySelector('.spinner-border').style.display = 'inline-block';
            d.getElementById('btnGuardar').setAttribute('disabled', true);
            $(document).find('[data-error="input"]').removeClass('is-invalid');
            $(document).find('[data-error="span"]').text('');
            axios.put('/mediano_plazo_acciones/'+ mediano_plazo_accion_uuid, {
                accion_mediano_plazo: d.getElementById('accion_mediano_plazo').value,
            })
            .then(function (resp){
                $('#modal').modal('hide');
                $('#acciones_mediano_plazo').DataTable().ajax.reload();
            })
            .catch(function (error){
                const objeto = error.response.data.errors; //creamos el objeto para luego recorrerlo
                if (error.response.data.hasOwnProperty('errors')) //preguntamos si exite la propiedad donde se almacenan los errores false/true
                {
                    d.querySelector('.spinner-border').style.display = 'none';
                    d.getElementById('btnGuardar').removeAttribute('disabled');
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

function delet(mediano_plazo_accion_uuid){
    d.getElementById('form_delete').onsubmit = function(e){
        e.preventDefault();
        axios.delete('/mediano_plazo_acciones/'+ mediano_plazo_accion_uuid)
        .then(function (resp){
            $('#modal_delete').modal('hide');
            $('#acciones_mediano_plazo').DataTable().ajax.reload();
        })
        .catch(function (error){
        })
    }
}

d.addEventListener('click', (e)=>{
    if(e.target.matches('[data-objetivo_gestion]')){
        let data = $('#acciones_mediano_plazo').DataTable().row($(e.target).parents('tr') ).data();
        location.href='/mediano_plazo_acciones/'+data.uuid+'/pei_objetivos_especificos';
    }

    if(e.target.matches('#nuevo') || e.target.matches('#nuevo *')){
        d.querySelector('.spinner-border').style.display = 'none';
        d.getElementById('btnGuardar').removeAttribute('disabled');
        $(document).find('[data-error="input"]').removeClass('is-invalid');
        $(document).find('[data-error="span"]').text('');
        d.getElementById('form').setAttribute('data-form', '');
        $("#form").trigger("reset");
        $("#modal .modal-title").text("Nuevo");
        $("#modal").modal("show");
    }

    if(e.target.matches('[data-edit]') || e.target.matches('[data-edit] *')){
        d.querySelector('.spinner-border').style.display = 'none';
        d.getElementById('btnGuardar').removeAttribute('disabled');
        $(document).find('[data-error="input"]').removeClass('is-invalid');
        $(document).find('[data-error="span"]').text('');
        d.getElementById('form').removeAttribute('data-form');
        let data = $('#acciones_mediano_plazo').DataTable().row($(e.target).parents('tr') ).data();
        $("#accion_mediano_plazo").val(data.accion_mediano_plazo);
        $("#modal .modal-title").text("Editar");
        $("#modal").modal("show");
    }

    if(e.target.matches('[data-delete]') || e.target.matches('[data-delete] *')){
        let data = $('#acciones_mediano_plazo').DataTable().row($(e.target).parents('tr') ).data();
        d.querySelector('.message').innerHTML = data.accion_mediano_plazo;
        $('#modal_delete').modal('show');
    }
})

d.addEventListener('submit', (e)=>{
    if(e.target.matches('#form')){
        if(e.target.hasAttribute('data-form')){
            e.preventDefault();
            d.querySelector('.spinner-border').style.display = 'inline-block';
            d.getElementById('btnGuardar').setAttribute('disabled', true);
            $(document).find('[data-error="input"]').removeClass('is-invalid');
            $(document).find('[data-error="span"]').text('');
            const datos = new FormData(e.target);
            axios.post('/mediano_plazo_acciones/'+ resultado_uuid, datos)
            .then(function (resp){
                $('#modal').modal('hide');
                $('#acciones_mediano_plazo').DataTable().ajax.reload(null, false);
            })
            .catch(function (error){
                // console.log(error.response.data.errors);
                const objeto = error.response.data.errors; //creamos el objeto para luego recorrerlo
                if (error.response.data.hasOwnProperty('errors')) //preguntamos si exite la propiedad donde se almacenan los errores false/true
                {
                    d.querySelector('.spinner-border').style.display = 'none';
                    d.getElementById('btnGuardar').removeAttribute('disabled');
                    for (let key in  objeto)
                    {
                        d.getElementById(key).classList.add('is-invalid');
                        d.getElementById(key+'-error').textContent = objeto[key];
                    }
                }
            })
        }
    }
})