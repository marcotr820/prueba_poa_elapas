$(function()
{
    //abrir modal de NUEVO
    $('#nueva_unidad').on('click', function(e)
    {
        $("#form_unidad").trigger("reset");
        $(".modal-title").text("Nuevo"); 
        $("#modal_unidad").modal("show");
        //añadimos la clase al formulario
        $('#modal_unidad #form_unidad').addClass('nuevo');
        //si cerramos el modal con errores al volver a abrirlo quitamos los errores anterires llamando a sus clases de cada elemento
        $(document).find('span.error-text').text('');
        $(document).find('input.form-control').removeClass('is-invalid');

    });

    //abrir el modal de editar
    $(document).on( 'click', '[data-edit]', function () {
        //eliminamos las clases que tenga el formulario al abrir el modal
        $('#modal_unidad #form_unidad').removeClass();
        //si cerramos el modal con errores al volver a abrirlo quitamos los errores anterires 
        $(document).find('span.error-text').text('');
        $(document).find('input.form-control').removeClass('is-invalid');
        let data = $('#unidades').DataTable().row($(this).parents('tr') ).data();
        
        let id_unidad = data['id'];
        let nombre_unidad = data['nombre_unidad'];
        let gerencia = data['gerencia_id'];

        $("#id_unidad").val(id_unidad);
        $("#nombre_unidad").val(nombre_unidad);
        $("#gerencia").val(gerencia);
        $(".modal-title").text("Editar"); 
        $("#modal_unidad").modal("show");
    } );

    //NUEVO registro
    $('#form_unidad').on('submit', function(e)
    {
        e.preventDefault();
        let datosform = $('#form_unidad').serializeArray();
        if($('#form_unidad').attr('class'))
        {
            $.ajax({
                url:$(this).attr('action'),
                type: 'POST',
                data: datosform,
                beforeSend:function(resp){
                    $(document).find('span.error-text').text('');
                    //a los elementos que llevan la clase form control y que esten llenados les quita la clase is-invalid
                    $(document).find('input.form-control').removeClass('is-invalid');
                    $(document).find('select.form-control').removeClass('is-invalid');
                },

                success:function(resp){
                    $('#unidades').DataTable().ajax.reload(null, false);
                    $("#modal_unidad").modal("hide");
                    //removemos la clase una ves registrado el trabajador
                    $('#form_unidad').removeClass('nuevo');
                },

                error:function(resp){
                    if(resp.responseJSON.hasOwnProperty('errors')){
                        $.each(resp.responseJSON.errors, function(key, value){
                            $('input[name='+ key +']').addClass('is-invalid'); //añadimos la clase is-invalid a los errores input
                            $('select[name='+ key +']').addClass('is-invalid'); //añadimos la clase is-invalid a los errores select
                            console.log(key);
                            console.log(value);
                            //mostramos los erroes que perteneve sl id del input donde se mostrara el error
                            $('span[id='+key+'Error]').text(value);
                        })
                    }
                }
            })
        }
        else
        {
            //obtenemos el id del campo que vamos a editar
            let id_unidad = $("#id_unidad").val();
            $.ajax({
                url:"/unidades/"+id_unidad,
                type: 'PUT',
                data: datosform,
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                    $(document).find('input.validacion').removeClass('is-invalid');
                    $(document).find('select.form-control').removeClass('is-invalid');
                },
                success:function(res){
                    //location.reload();
                    $('#unidades').DataTable().ajax.reload(null, false);
                    $("#modal_unidad").modal("hide");
                },
                error:function(respuesta){
                    if(respuesta.responseJSON.hasOwnProperty('errors')){
                        $.each(respuesta.responseJSON.errors, function(key, value){
                            $('input[name='+ key +']').addClass('is-invalid'); 
                            $('select[name='+ key +']').addClass('is-invalid'); 
                            // console.log(key);
                            // console.log(value);
                            $('span[id='+key+'Error]').text(value);
                        })
                    }
                }
            })
        }
    });


    //ELIMINAR registro
    $(document).on( 'click', '[data-delete]', function (e) 
    {
        e.preventDefault();
        let data = $('#unidades').DataTable().row($(this).parents('tr') ).data();
        let nombre_unidad = data['nombre_unidad'];
        //rescatamos el token del formulario de eliminar para enviarlo
        let datosform = $('.form_eliminar_unidad').serializeArray();

        Swal.fire({
            html: "Desea Eliminar el Registro : <br> <u><b>"+nombre_unidad+"</b></u>",
            width: '20%',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Si eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
                if (result.isConfirmed) 
                {
                    //almacenamos el id del objeto data obtenido
                    let id_unidad = data['id']; //id
                    //console.log(id_meta);
                    $.ajax
                    ({
                        url: "/unidades/" + id_unidad,
                        type: 'delete', 
                        data: datosform,  
                        success:function(resp)
                        {
                            $('#unidades').DataTable().ajax.reload(null, false);
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
        })

    } );
    
});