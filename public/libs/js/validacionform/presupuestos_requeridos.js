const d = document;
d.addEventListener('click', (e)=>{
   if(e.target.matches('#generar_pdf'))
   {
      let fecha_inicio = d.getElementById('fecha_inicio').value || null; //agregar la toma de valor por defecto si no tiene algun valor
      let fecha_fin = d.getElementById('fecha_fin').value || null;
      let iframepdf = d.getElementById('iframe_pdf');
      iframepdf.setAttribute('src', '/presupuestos_pdf/'+ fecha_inicio + '/' + fecha_fin);
      $('#modal_pdf').modal('show');
      // axios.get('/presupuestos_pdf', {
      //    params: {
      //      fecha_inicio: d.getElementById('fecha_inicio').value,
      //      fecha_fin: d.getElementById('fecha_fin').value,
      //    }
      // })
      // .then(function (response) {
      // })
      // .catch(function (error) {
      // });
   }
});

var inputs_date = document.querySelectorAll('input[type="date"]');
inputs_date.forEach((el)=>{
   el.addEventListener('change', (e)=>{
      if(d.getElementById('fecha_inicio').value != '' && d.getElementById('fecha_fin').value != ''){
         const dibujar_tabla = () =>{
            $('#presupuestos').DataTable({
               "destroy": true, /*metodo para destriur la tabla que tenemos al inicio y remplazarla por una nueva con nuevos datos*/
               "processing": true,
               "serverSide": true,
               "ajax": {
                  "url": "/presupuestos_requeridos",
                  "type": "GET",
                  "data": {
                     "fecha_inicio": document.getElementById('fecha_inicio').value,
                     "fecha_fin": document.getElementById('fecha_fin').value,
                  }
               },
               columns: [
                  { data: 'accion_corto_plazo', name:'accion_corto_plazo'},
                  { 
                     data: 'presupuesto_programado',
                     render: function(data, type) {
                     var number = $.fn.dataTable.render.number( ',', '.', 2, 'Bs ').display(data);
                           return number;
                     }
                  },
                  { data: 'fecha_inicio'}
               ]
            });
         }

         var fecha_inicio = d.getElementById('fecha_inicio').value;
         var fecha_fin = d.getElementById('fecha_fin').value;
         if(Date.parse(fecha_fin) > Date.parse(fecha_inicio)){
            dibujar_tabla(); /*llamamos a la funcion para refrescar la datatable*/
         }
         else{
            Swal.fire({
               icon: 'error',
               text: "Rango de fechas no valido",
               width: '20%',
               height: '20%',
               confirmButtonText: 'Aceptar',
           })
            d.getElementById('fecha_inicio').value = String(fecha_fin);
            dibujar_tabla(); /*llamamos a la funcion para refrescar la datatable*/
         }
         
      }
      
   })
});