<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   <!--style bootstrap4-->
   <link rel="stylesheet" href="{{asset('css/app.css')}}">
   <style>
      table th, td{
         border: solid 1px #7e7f7d;
      }
      th{
         background-color:skyblue;
         padding: 5px;
      }
   </style>
</head>
<body>
   <table width="100%">
      <thead>
         <tr>
            <th>accion corto plazo</th>
            <th>fecha requerida</th>
         </tr>
      </thead>
      <tbody>
         @forelse ($datos as $dato)
         <tr>
            <td>{{$dato->accion_corto_plazo}}</td>
            <td>{{$dato->fecha_inicio}}</td>
         </tr>
         @empty
         <tr>
            <td colspan="2">No existe registros</td>
         </tr>
         @endforelse
      </tbody>
   </table>
</body>
</html>