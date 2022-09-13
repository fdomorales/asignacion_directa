<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Asignación directa</title>

        <meta name="description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
        <!-- END Icons -->

        <!-- Estilos UTI -->
        <link rel="stylesheet" href="{{ asset('assets/css/estilo.css') }}">
        <link rel="stylesheet" href="https://use.typekit.net/nzq7jbs.css">
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

        <!-- Fonts and Codebase framework -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->

        <link rel="stylesheet" id="css-theme" href="{{ asset('assets/css/themes/corporate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        @yield('css')
        <style>
            #loader {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                width: 100%;
                background: rgba(0,0,0,0) url("/img/loading_pacman.gif") no-repeat center center;
                z-index: 99999;
            }
            .loading {
                z-index: 20;
                position: absolute;
                top: 0;
                left:-5px;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.4);
            }
            .loading-content {
                position: absolute;
                border: 16px solid #f3f3f3; /* Light grey */
                border-top: 16px solid #3498db; /* Blue */
                border-radius: 50%;
                width: 50px;
                height: 50px;
                top: 40%;
                left:35%;
                animation: spin 2s linear infinite;
            }
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
        <!-- END Stylesheets -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>{{-- cambiar CDN --}}
        <script src="{{ asset('assets/js/select2.min.js') }}"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> --}}
    </head>
    <body>
        <div id="page-container" class="sidebar-inverse side-scroll page-header-fixed page-header-glass page-header-inverse main-content-boxed">
            <!-- Sidebar -->
            <nav id="sidebar">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow bg-black-op-10">
                        <div class="content-header-section text-center align-parent">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="link-effect font-w700" href="index.html">
                                    <i class="fa fa-building-o text-primary"></i>
                                    <span class="font-size-xl text-dual-primary-dark">SERNATUR</span>
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                    </div>
                    <!-- END Side Header -->

                    <!-- Side Main Navigation -->
                    @if (auth()->user())
                        <div class="content-side content-side-full">
                            <!--
                                Mobile navigation, desktop navigation can be found in #page-header
                                If you would like to use the same navigation in both mobiles and desktops, you can use exactly the same markup inside sidebar and header navigation ul lists
                            -->
                            @role('Cliente')
                                <ul class="nav-main">
                                    <li><a class="active" href="{{ asset('/') }}"><i class="si si-rocket"></i>Inicio</a></li>
                                    <li><a href="{{route('index_customer')}}"><i class="si si-layers"></i>Mis postulaciones</a></li>
                                    <li><a href="{{route('show_customer', ['id'=> auth()->user()->id])}}"><i class="si si-notebook"></i>Mis Datos</a></li>
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="si si-logout"></i>Cerrar sesión</a></li>
                                </ul>
                            @else
                                <ul class="nav-main">
                                    <li><a class="active" href="{{ asset('/') }}"><i class="si si-rocket"></i>Inicio</a></li>
                                    <li><a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-layers"></i>Postulaciones</a>
                                        <ul>
                                            <li><a href="{{route('postulacion.index')}}">Postulantes</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-layers"></i>Listados</a>
                                        <ul>
                                            <li><a href="{{route('periodos')}}">Periodos</a></li>
                                            <li><a href="{{route('organizacion.index')}}">Organizaciones</a></li>
                                            <li><a href="{{route('calendario.index')}}">Calendarios</a></li>
                                            <li><a href="{{route('comunas.index')}}">Comunas</a></li>
                                            <li><a href="{{route('viaje.index')}}">Viajes</a></li>
                                            @role('Admin')
                                                <li><a href="{{route('usuarios.index')}}">Usuarios</a></li>
                                            @endrole
                                        </ul>
                                    </li>
                                </ul>
                            @endrole
                        </div>
                    @endif
                    <!-- END Side Main Navigation -->
                </div>
                <!-- Sidebar Content -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="content-header-section">
                        <!-- Logo -->
                            <a href="{{'/'}}" >
                            <img class="logo-vte" src="{{ asset('img/VTE-logo.png') }}">
                            </a>
                        <!-- END Logo -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="content-header-section">
                        @if (auth()->user())
                            <!-- Header Navigation -->
                            @role('Cliente')
                                <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav">
                                            <li class="nav-item dropdown">
                                                <a class="menu-perfil" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-user-circle"></i>
                                                    <span class="d-none d-sm-inline-block fw-semibold">{{ auth()->user()->name }} <i class="fa fa-chevron-down"></i></span>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="{{ route('index_customer') }}">
                                                        <i class="si si-layers"></i>
                                                        <span>Mis postulaciones </span>
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('show_customer', ['id'=> auth()->user()->id]) }}">
                                                        <i class="si si-notebook"></i>
                                                        <span>Mis Datos </span>
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                                        <span>Cerrar sesión </span>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            @else
                                <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav">
                                            <li class="nav-item">
                                                <a href="{{ asset('/') }}" class="nav-link menu-perfil">
                                                    <i class="si si-globe"></i>
                                                    <span>Inicio</span>
                                                </a>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle menu-perfil" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="si si-layers"></i>
                                                    <span class="d-none d-sm-inline-block fw-semibold">Postulaciones</span>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="{{ route('postulacion.index') }}">
                                                    <span>Postulantes </span>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle menu-perfil" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="si si-user"></i>
                                                    <span class="">{{ auth()->user()->name }}</span>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="{{ route('periodos') }}">
                                                        <span>Periodos </span>
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('organizacion.index') }}">
                                                        <span>Organizaciones </span>
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('calendario.index') }}">
                                                        <span>Calendarios </span>
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('comunas.index') }}">
                                                        <span>Comunas </span>
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('viaje.index') }}">
                                                        <span>Viajes </span>
                                                    </a>
                                                    @role('Admin')
                                                        <a class="dropdown-item" href="{{ route('usuarios.index') }}">
                                                            <span>Usuarios </span>
                                                        </a>
                                                    @endrole
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        <span>Cerrar sesión </span>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            @endrole
                            <!-- END Header Navigation -->

                            <!-- Toggle Sidebar -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                                <i class="fa fa-navicon"></i>
                            </button>
                            <!-- END Toggle Sidebar -->

                            <form action="{{route('logout')}}" method="POST" id="logout-form">
                                @csrf
                            </form>
                        @else
                            <a href="{{route('login')}}" class="btn btn-verde">Ingresar</a>   <a href="{{route('register')}}" class="btn btn-azul">Registrarse</a>
                        @endif
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Loader -->
                <div id="page-header-loader" class="overlay-header bg-primary">
                    <div class="content-header content-header-fullrow text-center">
                        <div class="content-header-item">
                            <i class="fa fa-sun-o fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                <!-- Header -->
                <div class="bg-header">
                    <div class="content content-top">

                    </div>
                </div>
                <!-- END Header -->
                <div class="imagen-header"></div>
                <!-- Page Content -->
                <div class="">
                    <!-- Breadcrumb -->
                    @yield('breadcrumb')
                    <div>
                        <section id="loading">
                            <div id="loading-content"></div>
                        </section>
                        <div>
                            <div id='loader'></div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="content">
                        @yield('contenido')
                    </div>
                    <!-- END Content -->
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="bg-primary-dark">
                <p class="text-center text-light pt-3">Servicio Nacional de Turismo Avda Condell Nº679, Providencia, Santiago</p>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <script>
            $(function() {
                $( "form" ).submit(function() {
                    $('#loader').show();
                });
            });
        </script>
        <script src="{{ asset('assets/js/codebase.core.min.js') }}"></script>

        <!--
            Codebase JS

            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at assets/_es6/main/app.js
        -->
        <script src="{{ asset('assets/js/codebase.app.min.js') }}"></script>

        <!-- Page JS Plugins -->
        <script src="{{ asset('assets/js/plugins/chartjs/Chart.bundle.min.js') }}"></script>

        <!-- Page JS Code -->
        <script src="{{ asset('assets/js/pages/db_corporate.min.js') }}" ></script>

        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" defer></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js" defer></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js" defer></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js" defer></script>
    </body>
</html>
