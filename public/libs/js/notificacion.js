document.addEventListener('DOMContentLoaded', (e) => { //evento que sirve para que al cargar la pantalla se ejecute mas rapido
        //console.log( "window loaded" );
        $.get('/notificacion', function(dato){
            //console.log(dato);
            dato === '0' ? $('#notificacion').attr('hidden', true) : $('#notificacion').html(dato);
        });
});