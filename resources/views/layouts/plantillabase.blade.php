<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    {{-- google font fuente --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!--asset nos posiciona en la carpeta public-->
    <link rel="stylesheet" type="text/css" href="{{asset('libs/css/plantilla_style.css')}}">

    {{-- configuraciones css --}}
    <link rel="stylesheet" type="text/css" href="{{asset('libs/css/config.css')}}">

    <!--style bootstrap4-->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!--css datatables-->
    <link rel="stylesheet" href="{{asset('libs/datatables/dataTables.bootstrap4.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('libs/datatables/fixedHeader.dataTables.min.css')}}"> --}}

    <!--fontawezome-->
    <link rel="stylesheet" href="{{asset('libs/fontawesome/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('libs/fontawesome/fontawesome.min.css')}}">

    {{-- Select2 --}}
    <link rel="stylesheet" href="{{asset('libs/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('libs/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    {{-- toastr --}}
    <link rel="stylesheet" href="{{asset('libs/plugins/toastr/toastr.min.css')}}">

    @yield('css')

</head>
<body class="body-fondo">
    <div class="main-wrapper">
        
            <!-- Loader -->
			<div id="loader-wrapper">
				<div id="loader">
					<div class="loader-ellips">
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					</div>
				</div>
			</div>
			<!-- /Loader -->

        <div class="sidebar">
            {{-- sidebar logo --}}
            <div class="logo-details d-flex justify-content-center">
                <div class="image">
                    <img src="{{asset('libs/img/logo_gota_agua.png')}}" alt="">
                </div>
                <span class="logo_name font-weight-bold">Elapas | <small>POA</small></span>
            </div>

            {{-- sidebar-list --}}
            <div class="sidebar-list">
                <ul>
                    <li class="bloque">
                        <a class="titulo">
                            <i class="fas fa-leaf"></i>
                            <span class="pl-2">Administración</span>
                            <i class="fas fa-angle-down flecha"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('trabajadores.index')}}" class="pl-4"><span class="pl-2">Trabajadores</span></a></li>
                            <li><a href="{{route('usuarios.index')}}" class="pl-4"><span class="pl-2">Usuarios</span></a></li>
                            <li><a href="{{route('roles.index')}}" class="pl-4"><span class="pl-2">Roles</span></a></li>
                            <li><a href="{{route('permissions.index')}}" class="pl-4"><span class="pl-2">Permisos</span></a></li>
                            <li><a href="{{route('gerencias.index')}}" class="pl-4"><span class="pl-2">Gerencias</span></a></li>
                            <li><a href="{{route('unidades.index')}}" class="pl-4"><span class="pl-2">Unidades</span></a></li>
                        </ul>
                    </li>
                    
                    @if (Auth::guard('usuario')->Check())
                        @if (Auth::guard('usuario')->user()->trabajador->poa_status === '1')
                            <li class="bloque">
                                <a href="{{route('poa.index')}}" class="titulo">
                                    <i class="fas fa-leaf"></i>
                                    <span class="pl-2">Plan Operativo Anual</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    <li class="bloque">
                        <a class="titulo">
                            <i class="fas fa-leaf"></i>
                            <span class="pl-2">Directriz</span>
                            <i class="fas fa-angle-down flecha"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('pilares.index')}}" class="pl-4"></i><span class="pl-2">Pilares</span></a></li>
                            <li><a href="{{route('partidas.index')}}" class="pl-4"></i><span class="pl-2">Partidas</span></a></li>
                        </ul>
                    </li>

                    <li class="bloque">
                        <a href="{{route('estados_trabajadores.index')}}" class="titulo">
                            <i class="fas fa-leaf"></i>
                            <span class="pl-2">Estado Trabajadores</span>
                        </a>
                    </li>

                    <li class="bloque">
                        <a href="{{route('admin_poa.index')}}" class="titulo">
                            <i class="fas fa-leaf"></i>
                            <span class="pl-2">Administrar estados POA</span>
                            <span class="badge" id="notificacion"></span>
                        </a>
                    </li>

                    <li class="bloque">
                        <a href="{{route('index.presupuestos')}}" class="titulo">
                            <i class="fas fa-leaf"></i>
                            <span class="pl-2">Presupuestos requeridos</span>
                        </a>
                    </li>

                    <li class="bloque">
                        <a href="{{route('principal')}}" class="titulo">
                            <i class="fas fa-leaf"></i>
                            <span class="pl-2">Principal</span>
                        </a>
                    </li>

                    <li class="bloque">
                        <a href="{{route('planificacion_evaluacion')}}" class="titulo">
                            <i class="fas fa-leaf"></i>
                            <span class="pl-2">Planificacion y Evaluacion</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main">
            <!--*****************CABEZA MENU**********************-->
            <div class="topbar">
                <div class="toggle" id="toggle">
                    <i class="fas fa-bars"></i>
                </div>
                @can('super.admin')
                    <p class="btn btn-success">soy un admin</p>
                @else
                    <p class="btn btn-danger">no soy admin</p>
                @endcan

                <!--mostramos los datos del usuario autenticado-->
                {{-- @if (Auth::guard('usuario')->Check()) --}}
                @if (Auth::guard('usuario')->Check())
                {{-- @if (auth()->guard('admin')->Check()) --}}
                {{-- {{Auth::guard('usuario')->user()->usuario}} --}}
                <h5 class="text-white">estas autenticado Bienvenido: *USUARIO* {{Auth::guard('usuario')->user()->usuario}}</h5>
                @else
                <h4 class="text-white">ERROR NO ESTAS SUTENTICADO</h4>
                @endif
    
                <nav class="navbar navbar-expand-lg">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        <span class="ml-2 mr-2">{{ Auth::guard('usuario')->user()->trabajador->nombre }}</span>
                    </a>
                    <!--agregamos las clases animate slideIn que creamos para el efecto-->
                    <div class="dropdown-menu dropdown-menu-right animate slideIn mr-3">
                        <a class="dropdown-item" href="">Action</a>
                        <a class="dropdown-item" href="">Ajustes</a>
                        <div class="dropdown-divider"></div>

                        <form action="/logout" method="POST">
                            @csrf
                            <!--usamos JS para que al momento de dar click en el enlace se envie el formulario
                            y asi no tendremos que usar un boton ripo submit-->
                            <a class="dropdown-item btn" onclick="this.closest('form').submit()"><i class="fas fa-sign-out-alt"></i> Salir</a>
                        </form>
                    </div>
                </nav>

            </div>
            
            <!--=================== inicio del contenido_menu del CUERPO ===================-->
            <div class="contenido_pagina">

                @yield('contenido')
                
            </div><!--div QUE TERMINA EL CONTENIDO DEL CUERPO DE LA PAGINA-->

            <footer class="footer">
               <strong class="text-muted">SISTEMA POA 2021</strong>
            </footer>

            {{-- ****** scroll topboton para subir hacia arriba *****--}}
            <div class="scroll-top ocultar-btn">
               <i class="fas fa-angle-up"></i>
            </div>

        </div><!--DIV QUE TERMINA EL MAIN-->

    </div>

    <!--incluimos el archivo jquery-->
    <script src="{{asset('libs/datatables/jquery-3.6.0.min.js')}}"></script>

    <!--js de la plantilla-->
    <script src="{{asset('libs/js/plantilla.js')}}"></script>

    <!--script bootstrap-->
    <script src="{{asset('js/app.js')}}"></script>

    <!--js datatables-->
    <script src="{{asset('libs/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('libs/datatables/dataTables.bootstrap4.min.js')}}"></script>

    {{-- js para mostrar las notificaciones al cargar la pagina --}}
    <script src="{{asset('libs/js/notificacion.js')}}"></script>

    {{-- Select2 --}}
    <script src="{{asset('libs/plugins/select2/js/select2.full.min.js')}}"></script>

    {{-- toastr --}}
    <script src="{{asset('libs/plugins/toastr/toastr.min.js')}}"></script>

   @yield('js')

</body>
</html>