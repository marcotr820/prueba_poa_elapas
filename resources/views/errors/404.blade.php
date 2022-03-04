<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--style bootstrap4-->
  <link rel="stylesheet" href="{{asset('css/app.css')}}">

  <!--asset nos posiciona en la carpeta public-->
  <link rel="stylesheet" type="text/css" href="{{asset('libs/css/errors.css')}}">

  <!--fontawezome-->
  <link rel="stylesheet" href="{{asset('libs/fontawesome/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('libs/fontawesome/fontawesome.min.css')}}">

  <title>Document</title>
</head>
<body>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-body">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>404 Error De Página</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline"> 404</h2>
        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle"></i> Oops! Página No Encontrada.</h3>
          <p>
            No pudimos encontrar la página que buscaba.
            Mientras tanto, <a href="javascript:history.back()">Retornar Atras</a> puede volver atras e intentar de Nuevo.
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>

  <!--script bootstrap-->
  <script src="{{asset('js/app.js')}}"></script>
</body>
</html>