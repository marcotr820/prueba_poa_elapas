const d = document;
function edit(resultado_uuid){
    d.getElementById('form').onsubmit = function(e){
        if(! e.target.hasAttribute('data-form')){
            d.querySelector('.spinner-border').style.display = 'inline-block';
            d.getElementById('btnGuardar').setAttribute('disabled', true);
            $(document).find('[data-error="textarea"]').removeClass('is-invalid');
            $(document).find('[data-error="span"]').text('');
            axios.put('/resultados/'+ resultado_uuid,{
                nombre_resultado: d.getElementById('nombre_resultado').value,
            })
            .then(function (resp){
                $('#modal').modal('hide');
                $('#resultados').DataTable().ajax.reload(); // tabla_actividades.ajax.reload(null, false);
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
    };
}

function delet(resultado_uuid){
    d.getElementById('form_delete').onsubmit = function(e){
        e.preventDefault();
        axios.delete('/resultados/'+ resultado_uuid)
        .then(function (resp){
            $('#modal_delete').modal('hide');
            $('#resultados').DataTable().ajax.reload();
        })
        .catch(function (error){
        })
    }
}

d.addEventListener('click', (e)=>{
    if(e.target.matches('[data-mediano]')){
        // let data = $('#resultados').DataTable().row($(this).parents('tr') ).data();
        let data = $('#resultados').DataTable().row($(e.target).parents('tr') ).data();
        location.href='/resultados/'+data.uuid+'/acciones_mediano_plazo';
    }

    if(e.target.matches('#nuevo')){
        d.querySelector('.spinner-border').style.display = 'none';
        d.getElementById('btnGuardar').removeAttribute('disabled');
        $(document).find('[data-error="span"]').text('');
        $(document).find('[data-error="textarea"]').removeClass('is-invalid');
        $("#form").trigger("reset");
        $("#modal .modal-title").text("Nuevo"); 
        d.getElementById('form').setAttribute('data-form', '');
        //si cerramos el modal con errores al volver a abrirlo quitamos los errores anterires llamando a sus clases de cada elemento
        $("#modal").modal("show");
    }

    if(e.target.matches('[data-edit]') || e.target.matches('[data-edit] *')){
        d.querySelector('.spinner-border').style.display = 'none';
        d.getElementById('btnGuardar').removeAttribute('disabled');
        $(document).find('[data-error="textarea"]').removeClass('is-invalid');
        $(document).find('[data-error="span"]').text('');
        d.getElementById('form').removeAttribute('data-form');
        let data = $('#resultados').DataTable().row($(e.target).parents('tr') ).data();
        $("#nombre_resultado").val(data.nombre_resultado);
        $(".modal-title").text("Editar"); 
        $("#modal").modal("show");
    }

    if(e.target.matches('[data-delete]') || e.target.matches('[data-delete] *')){
        // let data = $('#resultados').DataTable().row($(this).parents('tr') ).data();
        let data = $('#resultados').DataTable().row($(e.target).parents('tr') ).data();
        d.querySelector('.message').innerHTML = data.nombre_resultado;
        $('#modal_delete').modal('show');
    }
})

d.addEventListener('submit', (e)=>{
    if(e.target.matches('#form')){
        e.preventDefault();
        if(e.target.hasAttribute('data-form')){
            d.querySelector('.spinner-border').style.display = 'inline-block';
            d.getElementById('btnGuardar').setAttribute('disabled', true);
            let datosform = $('#form').serializeArray();
            $(document).find('[data-error="textarea"]').removeClass('is-invalid');
            $(document).find('[data-error="span"]').text('');
            $.ajax({
                // url:$(this).attr('action'),
                url: '/resultados/'+ meta_uuid,
                type: 'POST',
                data: datosform,
                beforeSend:function(resp){
                    $(document).find('span.error-text').text('');
                    //a los elementos que llevan la clase form control y que esten llenados les quita la clase is-invalid
                    $(document).find('input.form-control').removeClass('is-invalid');
                },
                success:function(resp){
                    $('#resultados').DataTable().ajax.reload(null, false);
                    $("#modal").modal("hide");
                    //removemos la clase una ves registrado el trabajador
                    $('#form_resultado').removeClass('nuevo');
                },
                error:function(resp){
                    if(resp.responseJSON.hasOwnProperty('errors')){
                        d.querySelector('.spinner-border').style.display = 'none';
                        d.getElementById('btnGuardar').removeAttribute('disabled');
                        $.each(resp.responseJSON.errors, function(key, value){
                            $('textarea[id='+ key +']').addClass('is-invalid');
                            // console.log(key);
                            // console.log(value);
                            //mostramos los erroes que perteneve sl id del input donde se mostrara el error
                            $('span[id='+key+'-error]').text(value);
                        })
                    }
                }
            })
        }
    }
})