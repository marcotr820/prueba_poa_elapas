const d = document;
function edit(accion_uuid){
    d.getElementById('form').onsubmit = function(e){
        if(! e.target.hasAttribute('data-form')){
            let datosform = $('#form').serializeArray();
            $.ajax({
                url:"/corto_plazo_acciones/" + accion_uuid,
                type: 'PUT',
                data: datosform,
                beforeSend:function(){
                    $(document).find('[data-error="input"]').removeClass('is-invalid');
                    $(document).find('[data-error="textarea"]').removeClass('is-invalid');
                    $(document).find('[data-error="span"]').text('');
                },
                success:function(res){
                    $('#corto_plazo_acciones').DataTable().ajax.reload(null, false);
                    $("#modal").modal("hide");
                },
                error:function(respuesta){
                    if(respuesta.responseJSON.hasOwnProperty('errors')){
                        $.each(respuesta.responseJSON.errors, function(key, value){
                            // console.log(key);
                            // console.log(value);
                            $('input[id='+ key +']').addClass('is-invalid');
                            $('span[id='+key+'-error]').text(value);
                            $('textarea[id='+ key +']').addClass('is-invalid'); 
                        })
                    }
                }
            })
        }
    }
}

function delet(accion_uuid){
    d.getElementById('form_delete').onsubmit = function(e){
        e.preventDefault();
        let datosform = $('#form_delete').serializeArray();
        $.ajax({
            url: "/corto_plazo_acciones/" + accion_uuid,
            type: 'delete', 
            data: datosform,  
            success:function(resp)
            {
                $('#corto_plazo_acciones').DataTable().ajax.reload(null, false);
                $('#modal_delete').modal('hide');
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

// evento click
d.addEventListener('click', (e)=>{
    if(e.target.matches('[data-planificacion]')){
        let data = $('#corto_plazo_acciones').DataTable().row($(e.target).parents('tr') ).data();
        location.href='/planificacion/'+data.uuid;
    }

    if(e.target.matches('[data-operaciones]')){
        let data = $('#corto_plazo_acciones').DataTable().row($(e.target).parents('tr') ).data();
        location.href='/corto_plazo_acciones/'+data.uuid+'/operaciones';
    }

    if(e.target.matches('#nuevo') || e.target.matches('#nuevo *')){
        $(document).find('[data-error="input"]').removeClass('is-invalid');
        $(document).find('[data-error="textarea"]').removeClass('is-invalid');
        $(document).find('[data-error="span"]').text('');
        $("#form").trigger("reset");
        $("#modal .modal-title").text("Nuevo"); 
        $("#modal").modal("show");
        d.getElementById('form').setAttribute('data-form', '');
    }

    if(e.target.matches('[data-edit]') || e.target.matches('[data-edit] *')){
        $(document).find('[data-error="input"]').removeClass('is-invalid');
        $(document).find('[data-error="textarea"]').removeClass('is-invalid');
        $(document).find('[data-error="span"]').text('');
        d.getElementById('form').removeAttribute('data-form');
        let data = $('#corto_plazo_acciones').DataTable().row($(e.target).parents('tr') ).data();
        $("#accion_corto_plazo").val(data.accion_corto_plazo);
        $("#gestion").val(data.gestion);
        $("#resultado_esperado").val(data.resultado_esperado);
        $("#presupuesto_programado").val(data.presupuesto_programado);
        $("#fecha_inicio").val(data.fecha_inicio);
        $("#fecha_fin").val(data.fecha_fin);
        $("#modal .modal-title").text("Editar"); 
        $("#modal").modal("show");
    }

    if(e.target.matches('[data-delete]') || e.target.matches('[data-delete] *')){
        e.preventDefault();
        $('#modal_delete').modal('show');
        let data = $('#corto_plazo_acciones').DataTable().row($(e.target).parents('tr') ).data();
        d.querySelector('.message').innerHTML = data.accion_corto_plazo;
    }
})

// evento submit
d.addEventListener('submit', (e)=>{
    if(e.target.matches('#form')){
        e.preventDefault();
        if(e.target.hasAttribute('data-form')){
            let datosform = $('#form').serializeArray();
            $.ajax({
                // url:$(this).attr('action'),
                url: '/corto_plazo_acciones/'+ pei_uuid,
                type: 'POST',
                data: datosform,
                beforeSend:function(resp){
                    $(document).find('[data-error="input"]').removeClass('is-invalid');
                    $(document).find('[data-error="textarea"]').removeClass('is-invalid');
                    $(document).find('[data-error="span"]').text('');
                },
                success:function(resp){
                    $('#corto_plazo_acciones').DataTable().ajax.reload(null, false);
                    $("#modal").modal("hide");
                },
                error:function(resp){
                    if(resp.responseJSON.hasOwnProperty('errors')){
                        $.each(resp.responseJSON.errors, function(key, value){
                            $('input[id='+key+']').addClass('is-invalid');
                            $('span[id='+key+'-error]').text(value);
                            $('textarea[id='+ key +']').addClass('is-invalid'); 
                        })
                    }
                }
            })
        }
    }
})