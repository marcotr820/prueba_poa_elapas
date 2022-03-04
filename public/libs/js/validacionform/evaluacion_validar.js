const d = document;
d.addEventListener('click', (e)=>{
   if(e.target.matches('#nuevo') || e.target.matches('#nuevo *'))
   {
      d.querySelector('.modal-title').textContent = 'Registrar Evaluacion';
      $('#modal_evaluacion').modal('show');
   }
})