const d = document;
d.addEventListener('DOMContentLoaded', (e) => {
    $(document).on( 'click', '#btn', function () {
        fila = $(this).closest("tr");
        const id_corto_plazo_accion = fila.find('td:eq(0)').attr('id'); //rescatamos el id que insertamos en un td de la accion corto plazo
        axios.get('/status_corto_plazo_accion/' + id_corto_plazo_accion) //enviamos todos los input del form
        .then(function (resp) {
            switch(parseInt(resp.data['status'])){
                case 0: $('#radio0').prop('checked', true); break;
                case 1: $('#radio1').prop('checked', true); break;

                case 2: $('#radio2').prop('checked', true); break;
                case 3: $('#radio2').prop('checked', true); break;

                case 4: $('#radio4').prop('checked', true); break;
            }
            $("#modal_admin_poa").modal("show");
        })
        .catch(function (error) {
        });
        $('#id_corto_plazo_accion').val(id_corto_plazo_accion);

        // $.ajax({
        //     url:"/status_corto_plazo_accion/" + id_corto_plazo_accion,
        //     type: 'GET',
        //     success:function(resp)
        //     {
        //         $("#modal_admin_poa").modal("show");
        //         resp.status === '0' ? $('#radio0').prop('checked', true) : ''; //chekeamos el estado de la accion corto plazo
        //         resp.status === '1' ? $('#radio1').prop('checked', true) : '';
        //         resp.status === '2' ? $('#radio2').prop('checked', true) : '';
        //         resp.status === '3' ? $('#radio3').prop('checked', true) : '';
        //     }
        // })
        // $('#id_corto_plazo_accion').val(id_corto_plazo_accion);
    } );

    // editar estado accion corto plazo
    $('#form_status_admin_poa').on('submit', function(e)
    {
        e.preventDefault();
        let id_corto_plazo_accion = $('#id_corto_plazo_accion').val();
        let datosform = $('#form_status_admin_poa').serializeArray();
            $.ajax({
                url:"/admin_poa/"+ id_corto_plazo_accion,
                type: 'PUT',
                data: datosform,
                success:function(resp){
                    $('#modal_admin_poa').modal('hide');
                    //tabla_admin_poa.ajax.reload(null, false);
                    axios.get('/notificacion')
                    .then(function(response){
                        if(response.data === 0){
                            d.getElementById('notificacion').setAttribute('hidden', true);
                        }else{
                            d.getElementById('notificacion').removeAttribute('hidden');
                            d.getElementById('notificacion').innerHTML = response.data;
                        }
                    })
                    .catch(function(error){

                    });
                }
            })
    });

});