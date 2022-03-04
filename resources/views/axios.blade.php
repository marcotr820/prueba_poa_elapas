@extends('layouts.plantillabase')
@section('contenido')

<div class="card">
   <div class="card-header d-inline">
      <h5 class="m-0">axios async await</h5>
      <button class="btn btn-danger" id="btn">refrescar</button>
   </div>
   <div class="card-body p-2">
      <section class="crud">
         <article>
            <div class="loading"><b><h5 class="m-0">Loading...</h5></b></div>
            <table id="axios" class="crud-table table table-striped" style="display: none" width="100%">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>NOMBRE</th>
                     <th>DOCUMENTO</th>
                     <th>CARGO</th>
                     <th>UNIDAD_ID</th>
                     <th>ACCIONES</th>
                  </tr>
               </thead>
               <tbody>
               </tbody>
            </table>
         </article>
      </section>

      <template id="crud-template">
         <tr>
            <td class="id"></td>
            <td class="name"></td>
            <td class="documento"></td>
            <td class="cargo"></td>
            <td class="unidad_id"></td>
            <td>
               <button class="boton btn btn-primary">btn</button>
            </td>
         </tr>
      </template>
   </div>
</div>

@endsection

@section('js')
   <script>
   document.addEventListener("DOMContentLoaded", (e)=>{
      const d = document,
      $table = d.querySelector(".crud-table"),
      $template = d.getElementById("crud-template").content,
      $fragment = d.createDocumentFragment();
      const getAll = async () => {
         try {
            let res = await axios.get("/trabajadores"),
               json = await res.data.data;
            console.log(json);
            json.forEach(el => {
               $template.querySelector(".id").textContent = el.id;
               $template.querySelector(".name").textContent = el.nombre;
               $template.querySelector(".documento").textContent = el.documento;
               $template.querySelector(".cargo").textContent = el.cargo;
               $template.querySelector(".unidad_id").textContent = el.unidad_id;
               $template.querySelector(".boton").value = el.id;
               let $clone = d.importNode($template, true);
               $fragment.appendChild($clone);
            });
            $table.querySelector("tbody").appendChild($fragment);
            d.querySelector('.loading').style.display = 'none';
            $table.style.display = 'table';
            $('#axios').DataTable({
               "order": [[ 0, 'desc' ]]
            });
         } catch (err) {
            let message = err.statusText || "Ocurrió un error";
            $table.insertAdjacentHTML("afterend", `<p><b>Error ${err.status}: ${message}</b></p>`);
         }
      }
      getAll();

      d.addEventListener('click', (e)=>{
         if(e.target.matches('#btn')){
            d.querySelector('.loading').style.display = 'block';
            $table.style.display = 'none';
            $('#axios').DataTable().clear().destroy();
            getAll();
         }

         if(e.target.matches('.boton')){
            alert(e.target.value);
         }
      })
      
   });
   </script>
@endsection
