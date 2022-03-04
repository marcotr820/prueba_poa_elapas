const d = document;
d.addEventListener('click', (e)=>{
    if(e.target.matches('[data-accion]')){
        // let data = tabla_poa.row($(this).parents('tr') ).data();
        let data = $('#poa').DataTable().row($(e.target).parents('tr') ).data();
        location.href='/pei_objetivos_especifico/'+data.uuid+'/corto_plazo_acciones';
    }
})