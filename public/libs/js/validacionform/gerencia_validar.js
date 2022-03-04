
const expresiones = {
    letra: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    numeros_digitos: /^\d{4}$/,
}

const d = document;
//abrir modal para agregar un nuevo pilar
$('#nueva_gerencia').on('click', function(e){
    var inputs = d.querySelectorAll('#form_gerencia [data-required]'); //obtenemos los input que tengan el atributo required
    inputs.forEach((input)=>{
        input.classList.remove('is-valid');
    });

    $("#form_gerencia").trigger("reset");
    $(".modal-title").text("Nueva Gerencia"); 
    $("#modal_gerencia").modal("show");
    
    //añadimos la clase al formulario
    $('#modal_gerencia #form_gerencia').addClass('nuevo');

    //si cerramos el modal con errores al volver a abrirlo quitamos los errores anterires llamando a sus clases de cada elemento
    $(document).find('span.error-text').text('');
    $(document).find('input.form-control').removeClass('is-invalid');//quitamos la clase is-invalid de todos los campos que la contengan al abrir el form

    const validar_campo = (expresion, input) =>{
        if (expresion.test(input.value)){
            d.getElementById(input.id).classList.remove('is-invalid');
            d.getElementById(`${input.id}Error`).textContent = '';
            d.getElementById(input.id).classList.add('is-valid');
        } else {
            d.getElementById(input.name).classList.add('is-invalid');
            d.getElementById(`${input.name}Error`).textContent = 'Este campo Solo puede contener letras';
        }
    }

    const validarform = (e)=>{
        const $input = e.target;
        switch ($input.name){
            case "nombre_gerencia":
                validar_campo(expresiones.letra, $input)
            break;
        }
    }

    inputs.forEach((input)=>{
        input.addEventListener('keyup', validarform);
    });

});

//abrir el modal de editar
$(document).on( 'click', '[data-edit]', function () {
    //eliminamos las clases que tenga el formulario al abrir el modal
    $('#modal_gerencia #form_gerencia').removeClass();

    //si cerramos el modal con errores al volver a abrirlo quitamos los errores anterires 
    $(document).find('span.error-text').text('');
    $(document).find('input.form-control').removeClass('is-invalid');
    let data = $("#gerencias").DataTable().row($(this).parents('tr') ).data();
    
    let id_gerencia = data['id'];
    let nombre_gerencia = data['nombre_gerencia'];

    $("#id_gerencia").val(id_gerencia);
    $("#nombre_gerencia").val(nombre_gerencia);
    $(".modal-title").text("Editar"); 
    $("#modal_gerencia").modal("show");

} );

//registro de nuevo pilar
$('#form_gerencia').on('submit', function(e){
    e.preventDefault();
    let datosform = $('#form_gerencia').serializeArray();
    if($('#form_gerencia').attr('class'))
    {
        $.ajax({
            url:$(this).attr('action'), //{{route('gerencias.store')}}
            type: 'POST',
            data: datosform,
            beforeSend:function(resp){
                $(document).find('span.error-text').text('');
                //a los elementos que llevan la clase form control y que esten llenados les quita la clase is-invalid
                $(document).find('input.form-control').removeClass('is-invalid');
                $(document).find('input.form-control').removeClass('is-valid');
            },
            success:function(resp){
                $("#gerencias").DataTable().ajax.reload(null, false);
                $("#modal_gerencia").modal("hide");
                //removemos la clase una ves registrado el trabajador
                $('#form_gerencia').removeClass('nuevo_pilar');
            },
            error:function(resp){
                if(resp.responseJSON.hasOwnProperty('errors')){
                    $.each(resp.responseJSON.errors, function(key, value){
                        $('input[name='+ key +']').addClass('is-invalid'); 
                        console.log(key);//mostramos los erroes que perteneve sl id del input donde se mostrara el error
                        console.log(value);
                        $('span[id='+key+'Error]').text(value);
                    })
                }
            }
        })
    }
    else
    {
        //obtenemos el id del campo que vamos a editar
        let id_gerencia = $("#id_gerencia").val();
        $.ajax({
            url:"/gerencias/" + id_gerencia,
            type: 'PUT',
            data: datosform,
            beforeSend:function(){
                $(document).find('span.error-text').text('');
                $(document).find('input.validacion').removeClass('is-invalid');
            },
            success:function(res){
                //location.reload();
                $("#gerencias").DataTable().ajax.reload(null, false);
                $("#modal_gerencia").modal("hide");
            },
            error:function(resp){
                if(resp.responseJSON.hasOwnProperty('errors')){
                    $.each(resp.responseJSON.errors, function(key, value){
                        $('input[name='+ key +']').addClass('is-invalid'); 
                        console.log(key);
                        console.log(value);
                        $('span[id='+key+'Error]').text(value);
                    })
                }
            }
        })
    }
});

//boton eliminar
$(document).on( 'click', '[data-delete]', function (e) 
{
    e.preventDefault();
    let data = $("#gerencias").DataTable().row($(this).parents('tr') ).data();
    let nombre_gerencia = data['nombre_gerencia'];
    //rescatamos el token del formulario de eliminar para enviarlo
    let datosform = $('#form_eliminar_gerencia').serializeArray();
    Swal.fire({
        html: "Desea Eliminar El Registro: <br> <u><b>"+nombre_gerencia+"</b></u>",
        width: '20%',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Si eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
            if (result.isConfirmed) 
            {
                //almacenamos el id del objeto data obtenido
                let id_gerencia = data['id']; //id del registro
                $.ajax
                ({
                    url: "/gerencias/" + id_gerencia,
                    type: 'delete', 
                    data: datosform,  
                    success:function(resp)
                    {
                        $("#gerencias").DataTable().ajax.reload(null, false);
                        //toast
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'bottom-end',
                            showConfirmButton: false,
                            timer: 2500,
                            width: '20%',
                            timerProgressBar: true,
                        })
                        Toast.fire({
                            icon: 'success',
                            title: 'Se elimino el registro'
                        })
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