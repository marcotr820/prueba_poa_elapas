const d = document;
function edit(pei_objetivo_uuid){
    d.getElementById('form').onsubmit = function(e){
        if(! e.target.hasAttribute('data-form')){
            d.querySelector('.spinner-border').style.display = 'inline-block';
            d.getElementById('btnGuardar').setAttribute('disabled', true);
            let datosform = $('#form').serializeArray();
            $.ajax({
                url:"/pei_objetivos_especificos/" + pei_objetivo_uuid,
                type: 'PUT',
                data: datosform,
                beforeSend:function(){
                    $(document).find('[data-error="span"]').text('');
                    $(document).find('[data-error="input"]').removeClass('is-invalid');
                    $(document).find('[data-error="select"]').removeClass('is-invalid');
                    $(document).find('[data-error="textarea"]').removeClass('is-invalid');
                },
                success:function(res){
                    $('#pei_objetivos_especificos').DataTable().ajax.reload(null, false);
                    $("#modal").modal("hide");
                },
                error:function(respuesta){
                    if(respuesta.responseJSON.hasOwnProperty('errors')){
                        d.querySelector('.spinner-border').style.display = 'none';
                        d.getElementById('btnGuardar').removeAttribute('disabled');
                        $.each(respuesta.responseJSON.errors, function(key, value){
                            // console.log(key);
                            // console.log(value);
                            $('input[id='+ key +']').addClass('is-invalid');
                            $('select[id='+ key +']').addClass('is-invalid'); 
                            $('textarea[id='+ key +']').addClass('is-invalid'); 
                            $('span[id='+key+'-error]').text(value);
                        })
                    }
                }
            })
        }
    }
}

function delet(pei_objetivo_uuid){
    d.getElementById('form_delete').onsubmit = function(e){
        e.preventDefault();
        let datosform = $('#form_delete').serializeArray();
        $.ajax({
            url: "/pei_objetivos_especificos/" + pei_objetivo_uuid,
            type: 'delete', 
            data: datosform,
            success:function(resp)
            {
                $('#modal_delete').modal('hide');
                $('#pei_objetivos_especificos').DataTable().ajax.reload(null, false);
            },
            error:function()
            {
                Swal.fire({
                    icon: 'error',
                    html: "No se pudo eliminar el registro",
                    width: '20%',
                    confirmButtonText: 'Aceptar',
                })
            }
        })
    }
}

d.addEventListener('click', (e)=>{
    if(e.target.matches('#nuevo') || e.target.matches('#nuevo *')){
        d.querySelector('.spinner-border').style.display = 'none';
        d.getElementById('btnGuardar').removeAttribute('disabled');
        $(document).find('[data-error="span"]').text('');
        $(document).find('[data-error="input"]').removeClass('is-invalid');
        $(document).find('[data-error="select"]').removeClass('is-invalid');
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
        $(document).find('[data-error="span"]').text('');
        $(document).find('[data-error="input"]').removeClass('is-invalid');
        $(document).find('[data-error="select"]').removeClass('is-invalid');
        $(document).find('[data-error="textarea"]').removeClass('is-invalid');
        d.getElementById('form').removeAttribute('data-form');
        // let data = $('#pei_objetivos_especificos').DataTable().row($(this).parents('tr') ).data();
        let data = $('#pei_objetivos_especificos').DataTable().row($(e.target).parents('tr') ).data();
        $("#objetivo_institucional").val(data.objetivo_institucional);
        $("#ponderacion").val(data.ponderacion);
        $("#indicador_proceso").val(data.indicador_proceso);
        $("#gerencia_id").val(data.gerencia_id);
        $("#modal .modal-title").text("Editar"); 
        $("#modal").modal("show");
    }

    if(e.target.matches('[data-delete]') || e.target.matches('[data-delete] *')){
        // let data = $('#pei_objetivos_especificos').DataTable().row($(this).parents('tr') ).data();
        let data = $('#pei_objetivos_especificos').DataTable().row($(e.target).parents('tr') ).data();
        d.querySelector('.message').innerHTML = data.objetivo_institucional;
        $('#modal_delete').modal('show');
    }
})

d.addEventListener('submit', (e)=>{
    if(e.target.matches('#form')){
        e.preventDefault();
        if(e.target.hasAttribute('data-form')){
            d.querySelector('.spinner-border').style.display = 'inline-block';
            d.getElementById('btnGuardar').setAttribute('disabled', true);
            var datosform = $('#form').serializeArray();
            $.ajax({
                // url:$(this).attr('action'),
                url: '/pei_objetivos_especificos/' + mediano_plazo_accion_uuid,
                type: 'POST',
                data: datosform,
                beforeSend:function(resp){
                    $(document).find('[data-error="span"]').text('');
                    $(document).find('[data-error="input"]').removeClass('is-invalid');
                    $(document).find('[data-error="select"]').removeClass('is-invalid');
                    $(document).find('[data-error="textarea"]').removeClass('is-invalid');
                },
                success:function(resp){
                    // console.log(resp);
                    $('#pei_objetivos_especificos').DataTable().ajax.reload(null, false);
                    $("#modal").modal("hide");
                },
                error:function(resp){
                    if(resp.responseJSON.hasOwnProperty('errors')){
                        d.querySelector('.spinner-border').style.display = 'none';
                        d.getElementById('btnGuardar').removeAttribute('disabled');
                        $.each(resp.responseJSON.errors, function(key, value){
                            // console.log(key);
                            // console.log(value);
                            $('input[id='+ key +']').addClass('is-invalid');
                            $('select[id='+ key +']').addClass('is-invalid'); 
                            $('textarea[id='+ key +']').addClass('is-invalid'); 
                            $('span[id='+key+'-error]').text(value);
                        })
                    }
                }
            })
        }
    }
})