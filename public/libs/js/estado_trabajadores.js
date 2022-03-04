const d = document;
d.addEventListener('click', (e)=>{
    if(e.target.matches('[data-operaciones]')){
        let data = $('#estados_trabajadores').DataTable().row($(e.target).parents('tr') ).data();
        location.href = 'operaciones_tareas/'+data.uuid;
    }

    if(e.target.matches('[data-requerimientos]')){
        let data = $('#estados_trabajadores').DataTable().row($(e.target).parents('tr') ).data();
        alert(data);
    }
})
//CAMBIAR ESTADO POA
$(document).on( 'change', '#estado_poa', function () {
    let data = $('#estados_trabajadores').DataTable().row($(this).parents('tr') ).data();
    let id_trabajador = data['id'];
    //verificamos si el switch esta checked para darle un valor
    //($("._switch").is(':checked')) ? $("._switch").val('1') : $("._switch").val('0');

    //let poa_status = $("._switch").val();

    let poa_status = $('._switch', this).prop('checked') == true ? '1' : '0';
    $.ajax({
        url:"/estados_trabajadores/poa_status/"+ id_trabajador,
        type: 'PUT',
        data: {
            poa_status,
            "_token": $('meta[name="csrf_token"]').attr('content')
        },
        success:function(resp){
            $('#estados_trabajadores').DataTable().ajax.reload(null, false);
        },
        error:function(resp){
        }
    })

} );

//CAMBIO ESTADO DE EVALUACION
$(document).on( 'change', '[data-evaluar]', function () {
    const data = $('#estados_trabajadores').DataTable().row($(this).parents('tr') ).data();
    if(data.poa_evaluacion === '1'){
        d.getElementById(data.id+'evaluacion').value = '0';
        var poa_evaluacion = d.getElementById(data.id+'evaluacion').value
        // console.log(d.getElementById(data.id+'evaluacion').value);
    }
    else{
        d.getElementById(data.id+'evaluacion').value = '1';
        var poa_evaluacion = d.getElementById(data.id+'evaluacion').value
        // console.log(d.getElementById(data.id+'evaluacion').value);
    }
    // let data = $('#estados_trabajadores').DataTable().row($(this).parents('tr') ).data();
    let id_trabajador = data.id;
    // //verificamos si el input esta checked para darle un valor
    // ($("[data-evaluar]").is(':checked')) ? $("[data-evaluar]").val('1') : $("[data-evaluar]").val('0');

    // let poa_evaluacion = $("[data-evaluar]").val();
    $.ajax({
        url:"/estados_trabajadores/poa_evaluacion/"+ id_trabajador,
        type: 'PUT',
        data: {
            poa_evaluacion,
            "_token": $('meta[name="csrf_token"]').attr('content')
        },
        success:function(resp){
            $('#estados_trabajadores').DataTable().ajax.reload(null, false);
        },
        error:function(resp){
            
        }
    })

} );

d.addEventListener('click', (e)=>{
    if(e.target.matches('[data-habilitar="creacion"]')){
        axios.get('/estados_trabajadores/habilitar_creacion_all')
        .then(function (resp) {
            $('#estados_trabajadores').DataTable().ajax.reload(null, false);
        })
        .catch(function (error) {
        });
    }

    if(e.target.matches('[data-deshabilitar="creacion"]')){
        axios.get('/estados_trabajadores/deshabilitar_creacion_all')
        .then(function (resp) {
            $('#estados_trabajadores').DataTable().ajax.reload(null, false);
        })
        .catch(function (error) {
        });
    }
})