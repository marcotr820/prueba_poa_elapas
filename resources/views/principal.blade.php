@extends('layouts.plantillabase')
@section('contenido')
        <h4>hack principal</h4>
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <!--mostramos los datos del usuario autenticado-->
        {{ Auth::guard('usuario')->user()->trabajador }}
<div class="card">
    <div class="card-body bg-dark text-white">
        <table id="example" class="table table-striped table-dark display" style="width:100%">
            <thead class="thead bg-primary">
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>lorem ipsu</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                </tr>
                <tr>
                    <td>Garrett Winters</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>63</td>
                    <td>2011/07/25</td>
                    <td>$170,750</td>
                </tr>
                
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

@endsection

@section('js')
        
    <script>
        console.log("se cargo el contenido de la pagina principal");
        $('#example').DataTable();

        toastr["success"]("My name is Inigo Montoya. You killed my father. Prepare to die!");
        toastr["error"]("Are you the six fingered man?");
        toastr["warning"]("Inconceivable!");
    </script>

@endsection