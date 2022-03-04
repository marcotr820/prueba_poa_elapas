@extends('layouts.plantillabase')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css">
@endsection

@section('contenido')
<div class="card">
   <div class="card-header">
      Gridjs
   </div>
   <div class="card-body p-1">
      <div id="loading"><b>Loading...</b></div>
      <div id="wrapper"></div>
   </div>
 </div>
   
@endsection

@section('js')
<script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', (e)=>{
      const getAll = async () => {
         try {
            let res = await axios.get("/trabajadores"),
               json = await res.data.data;
            console.log(json);
            new gridjs.Grid({
               columns: [
                  {id:'id', name:'ID'},
                  {id:'documento', name:'DOCUMENTO'},
                  {id:'nombre', name:'NOMBRE'},
               ],
               data: json,
               sort: true,
               search: {
                  enabled: true
               },
               pagination: true,
            }).render(document.getElementById("wrapper"));
            document.getElementById("loading").style.display = 'none';
            document.getElementById("wrapper").style.display = 'block';
         } catch (err) {
            let message = err.statusText || "Ocurrió un error";
         }
      }
      getAll();

   });
</script>
@endsection