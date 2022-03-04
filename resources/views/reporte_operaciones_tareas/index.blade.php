@extends('layouts.plantillabase')

@section('css')
<style>
   table th, td{
       border: 0.5px solid black;
       border-collapse: collapse;
       font-size: 10px;
       /* padding: 5px; */
   }
   th{
       text-align: center;
   }
</style>
@endsection

@section('contenido')
   <div class="">
      <h5 class=""><b>Determinacion de Operaciones y Tareas</b> <a href="{{route('operaciones_tareas_pdf', $trabajador)}}" class="btn btn-primary">Generar PDF</a> </h5>
      <h5><b>Trabajador:</b> {{$trabajador->nombre}}</h5>
      <h5><b>Gerencia:</b> {!!$trabajador->unidad->gerencia->nombre_gerencia!!}</h5>
      <h5><b>Cargo:</b> {{$trabajador->cargo}}</h5>
   </div>
   <!-- CSRF Token -->
   {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
   
   <!--token para cambiar de estado-->
   <meta name="csrf_token" content="{{ csrf_token() }}">

   <div class="card">
      <table style="width:100%;">
         <thead class="thead bg-primary">
            <tr>
               <th>Accion Corto Plazo</th>
               <th>Operaciones</th>
               <th>Actividades</th>
               <th>Tareas Especificas</th>
            </tr>
         </thead>
   
         <tbody>
            @forelse ($trabajador->corto_plazo_acciones as $corto_plazo_accion)
               <tr>
               <td rowspan="{{$corto_plazo_accion->operaciones->count() + $corto_plazo_accion->actividades->count() + $corto_plazo_accion->tareas_especificas->count() + 1}}">{{$corto_plazo_accion->accion_corto_plazo}}->{{$corto_plazo_accion->id}}</td>
               </tr>
               @foreach ($corto_plazo_accion->operaciones as $operacion)
                  <tr>
                  <td rowspan="{{$operacion->actividades->count() + $operacion->tareas_especificas->count() + 1}}">{{$operacion->tareas_especificas->count()}}***{{$operacion->nombre_operacion}}->{{$operacion->id}}</td>
                  </tr>
                  @foreach ($operacion->actividades as $actividad)
                     <tr>
                     <td rowspan="{{$actividad->tareas_especificas->count() + 1}}">{{$actividad->nombre_actividad}}->{{$actividad->id}}</td>
                     </tr>
                     @foreach ($actividad->tareas_especificas as $tarea_especifica)
                        <tr>
                        <td rowspan="">{{$tarea_especifica->nombre_tarea}}->{{$tarea_especifica->id}}</td>
                        </tr>
                     @endforeach
                  @endforeach
               @endforeach
   
            @empty
               <tr>
               <td colspan="5"><b>El Trabajador No Cuenta con registros</b></td>
               </tr>  
            @endforelse
         </tbody>
      </table>
   </div>

@endsection

@section('js')
    
    <script type="text/javascript">
        
    </script>

    <script src="{{asset('libs/js/estado_trabajadores.js')}}"></script>

@endsection