<style>
   table th, td{
      border: 0.2px solid #a6a6a6;
   }
   table{
      font-size: 7px;
      border-collapse: collapse;
   }
   th{
      background-color:skyblue;
   }
</style>
@forelse ($acciones_corto_plazo as $acp)
   <table width="100%">
      <thead>
         <tr>
            <th>ACCION CORTO PLAZO</th>
            <th>OPERACIONES</th>
            <th>ACTIVIDADES</th>
            <th>TAREAS ESPECIFICAS</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td
            <?php $row_acc = 0;
            if ($acp->operaciones->count() > 1) {
               $row_acc += $acp->operaciones->count() - 1;
            }
            foreach ($acp->operaciones as $op) {
               if ($op->actividades->count() > 1) {
                  $row_acc += $op->actividades->count() - 1;
               }
               foreach ($op->actividades as $act) {
                  if ($act->tareas_especificas->count() > 1) {
                     $row_acc += $act->tareas_especificas->count() - 1;
                  }
               }
            }
            echo 'rowspan="'.($row_acc + 1).'"';
            ?>
            >{{$acp->accion_corto_plazo}}</td>
            {{-- primera operacion --}}
            @foreach ($acp->operaciones as $op1)
               @if ($loop->first)
                  <?php $var_op_p = $op1; ?>
                  <td
                  <?php $row_op = 0;
                  if ($op1->actividades->count() > 1) {
                     $row_op += $op1->actividades->count() - 1;
                  }
                  foreach ($op1->actividades as $act) {
                     if ($act->tareas_especificas->count() > 1) {
                        $row_op += $act->tareas_especificas->count() - 1;
                     }
                  }
                  echo 'rowspan="'.($row_op + 1).'"'; 
                  ?>
                  >{{$op1->nombre_operacion}}->{{$op1->id}}nocuentaLL</td>
                  {{-- primera actividad de la primera operacion --}}
                  @foreach ($op1->actividades as $act1)
                     @if ($loop->first)
                     <?php $var_act_p = $act1; ?>
                        <td rowspan="{{$act1->tareas_especificas->count()}}">{{$act1->nombre_actividad}}nocuentaKK</td>
                        {{-- primera tarea primera actividad--}}
                        @foreach ($act1->tareas_especificas as $tar)
                           @if ($loop->first)
                              <td>{{$tar->nombre_tarea}}nocuenta</td>
                           @endif
                        @endforeach
                     @endif
                  @endforeach
               @endif
            @endforeach
         </tr>
         {{-- demas tareas primera actividad --}}
         @if (isset($var_act_p))
            @foreach ($var_act_p->tareas_especificas as $tar)
               @if (! $loop->first)
                  <tr>
                     <td>{{$tar->nombre_tarea}}FF</td>
                  </tr>
               @endif
            @endforeach
            <?php $var_act_p = null; ?>
         @endif
         {{-- demas actividades primera operacion --}}
         @if (isset($var_op_p)) {{-- si la variable esta definida entra --}}
            @foreach ($var_op_p->actividades as $act)
               @if (! $loop->first)
                  <tr>
                     <td rowspan="{{$act->tareas_especificas->count()}}">{{$act->nombre_actividad}}OO</td>
                     {{-- primera tarea demas actividades --}}
                     @foreach ($act->tareas_especificas as $tar)
                        @if ($loop->first)
                           <td>{{$tar->nombre_tarea}}</td>
                        @endif
                     @endforeach
                  </tr>
                  {{-- demas tareas demas actividades --}}
                  @foreach ($act->tareas_especificas as $tar)
                     @if (! $loop->first)
                        <tr>
                           <td>{{$tar->nombre_tarea}}</td>
                        </tr>
                     @endif
                  @endforeach
               @endif
            @endforeach
            <?php $var_op_p = null; ?>
         @endif
         {{-- demas operaciones --}}
         @foreach ($acp->operaciones as $op)
            @if (! $loop->first)
               <tr>
                  <td
                  <?php $row_op = 0;
                  if ($op->actividades->count() > 1) {
                     $row_op += $op->actividades->count() - 1;
                  }
                  foreach ($op->actividades as $act) {
                     if ($act->tareas_especificas->count() > 1) {
                        $row_op += $act->tareas_especificas->count() - 1;
                     }
                  }
                  echo 'rowspan="'.($row_op + 1).'"'; 
                  ?>
                  >{{$op->nombre_operacion}}</td>
                  {{-- primera actividad demas operaciones --}}
                  @foreach ($op->actividades as $act)
                     @if ($loop->first)
                        <?php $var_act = $act; ?>
                        <td rowspan="{{$act->tareas_especificas->count()}}">{{$act->nombre_actividad}}nocuentaMM</td>
                        {{-- primera tarea, primera actividad, demas operaciones--}}
                        @foreach ($act->tareas_especificas as $tar)
                           @if ($loop->first)
                              <td>{{$tar->nombre_tarea}}nocuentaHH</td>
                           @endif
                        @endforeach
                     @endif
                  @endforeach
               </tr>
               {{-- demas tareas, primera actividad, demas operaciones --}}
               @if (isset($var_act))
                  @foreach ($var_act->tareas_especificas as $tar)
                     @if (! $loop->first)
                        <tr>
                           <td>{{$tar->nombre_tarea}}vv</td>
                        </tr>
                     @endif
                  @endforeach
                  <?php $var_act = null; ?>
               @endif
               {{-- demas actividades demas operaciones --}}
               @foreach ($op->actividades as $act)
                  @if (! $loop->first)
                     <tr>
                        <td rowspan="{{$act->tareas_especificas->count()}}">{{$act->nombre_actividad}}dd</td>
                        {{-- primera tarea, demas actividades, demas operaciones --}}
                        @foreach ($act->tareas_especificas as $tar)
                           @if ($loop->first)
                              <td>{{$tar->nombre_tarea}}WW</td>
                           @endif
                        @endforeach
                     </tr>
                     @foreach ($act->tareas_especificas as $tar)
                        @if (! $loop->first)
                        <tr>
                           <td>{{$tar->nombre_tarea}}AA</td>
                        </tr>
                        @endif
                     @endforeach
                  @endif
               @endforeach
            @endif
         @endforeach
      </tbody>
   </table>
   @if ($acp != $loop->last)
      <div pagebreak="true"></div>
   @endif
@empty
   <p>El trabajador no cuenta con registros.</p>
@endforelse