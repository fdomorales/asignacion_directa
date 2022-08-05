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

    <!-- Stylesheets -->

    <!-- Fonts and Codebase framework -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
    
    
    <link rel="stylesheet" id="css-theme" href="{{ asset('assets/css/themes/corporate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>{{-- cambiar CDN --}}
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <!-- END Stylesheets -->
{{--     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
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
                    @role('Customer')
                    <ul class="nav-main">
                        <li>
                            <a class="active" href="{{ asset('/') }}"><i class="si si-rocket"></i>Inicio</a>
                        </li>
                        <li>
                            <a href="{{route('index_customer')}}"><i class="si si-layers"></i>Mis postulaciones</a>
                        </li>
                        <li>
                            <a href="#"><i class="si si-notebook"></i>Mis Datos</a>
                        </li>
                    </ul>
                    @else
                    <ul class="nav-main">
                        <li>
                            <a class="active" href="{{ asset('/') }}"><i class="si si-rocket"></i>Inicio</a>
                        </li>
                        <li>
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-layers"></i>Postulaciones</a>
                            <ul>
                                <li>
                                    <a href="{{route('postulacion.index')}}">Postulantes</a>
                                </li>
                                <!-- <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">More</a>
                                    <ul>
                                        <li>
                                            <a href="">Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="">Resources</a>
                                        </li>
                                    </ul>
                                </li> -->
                            </ul>
                        </li>
                        <li>
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-layers"></i>Listados</a>
                            <ul>
                                <li>
                                    <a href="{{route('periodos')}}">Periodos</a>
                                </li>
                                <li>
                                    <a href="{{route('organizacion.index')}}">Organizaciones</a>
                                </li>
                                <li>
                                    <a href="{{route('calendario.index')}}">Calendarios</a>
                                </li>
                                <li>
                                    <a href="{{route('comunas.index')}}">Comunas</a>
                                </li>
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
                    <div class="content-header-item mr-5">
                        <a class="link-effect font-w600" href="{{'/'}}" style="font-size: 70px;">
                            <img class="content-header-logo" src="{{ asset('img/franja_chile.png') }}">

                            {{-- <span class="text-dual-primary-dark">code</span><span class="text-primary">base</span> --}}
                        </a>
                    </div>
                    <!-- END Logo -->

                    
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="content-header-section">
                    <!-- Header Navigation -->
                        <!--
                        Desktop Navigation, mobile navigation can be found in #sidebar

                        If you would like to use the same navigation in both mobiles and desktops, you can use exactly the same markup inside sidebar and header navigation ul lists
                        If your sidebar menu includes headings, they won't be visible in your header navigation by default
                        If your sidebar menu includes icons and you would like to hide them, you can add the class 'nav-main-header-no-icons'
                    -->
                    @if (auth()->user())
                    @role('Customer')
                    <ul class="nav-main-header">
                        <li>
                            <a class="active" href="{{ asset('/') }}"><i class="si si-globe"></i>Inicio</a>
                        </li>
                        <li>
                            <a href="{{route('index_customer')}}"><i class="si si-layers"></i>Mis Postulaciones</a>
                        </li>
                        <li>
                            <a  href="{{route('show_customer', ['id'=> auth()->user()->id])}}"><i class="si si-notebook"></i>Mis Datos</a>
                        </li>
                    </ul>
                    @else
                    <ul class="nav-main-header">
                        <li>
                            <a class="active" href="{{ asset('/') }}"><i class="si si-globe"></i>Inicio</a>
                        </li>
                        <!-- <li>
                            <a href=""><i class="si si-settings"></i>Settings</a>
                        </li> -->
                        <li>
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-layers"></i>Postulaciones</a>
                            <ul>
                                <li>
                                    <a href="{{route('postulacion.index')}}">Postulantes</a>
                                </li>
                                <!-- <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">More</a>
                                    <ul>
                                        <li>
                                            <a href="">Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="">Resources</a>
                                        </li>
                                    </ul>
                                </li> -->
                            </ul>
                        </li>
                        <li>
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-layers"></i>Listados</a>
                            <ul>
                                <li>
                                    <a href="{{route('periodos')}}">Periodos</a>
                                </li>
                                <li>
                                    <a href="{{route('organizacion.index')}}">Organizaciones</a>
                                </li>
                                <li>
                                    <a href="{{route('calendario.index')}}">Calendarios</a>
                                </li>
                                <li>
                                    <a href="{{route('comunas.index')}}">Comunas</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @endrole
                    
                    
                    <!-- END Header Navigation -->

                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                        <i class="fa fa-navicon"></i>
                    </button>
                    <!-- END Toggle Sidebar -->
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
            <div class="bg-primary-dark">
                <div class="content content-top">
                    <div class="row push">
                        <div class="col-md py-10 d-md-flex align-items-md-center text-center">
                            <h1 class="text-white mb-0">
                                <span class="font-w400 font-size-lg text-white-op d-none d-md-inline-block">Sistema de</span>
                                <span class="font-w300">Asignación directa</span>
                            </h1>
                        </div>
                        <div class="col-md py-10 d-md-flex align-items-md-center justify-content-md-end text-center">
                            @if ( auth()->user() )
                            <button type="button" class="btn btn-alt-primary">
                                <i class="si si-user"></i>  {{ auth()->user()->name }}
                            </button>
                                
                            @else
                            <a type="button" class="btn btn-alt-primary" href="{{route('login')}}">
                                <i class="si si-login"></i>  Ingresar
                            </a>
                            &nbsp;
                            
                            <a type="button" class="btn btn-alt-success" href="{{route('register')}}">
                                <i class="si si-user"></i>  Registrarse
                            </a>
                                
                            @endif
                            &nbsp;
                            @if (auth()->user())
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="si si-logout"></i> salir
                                </button>
                            </form>
                                
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Header -->

            <!-- Page Content -->
            <div class="bg-white">
                <!-- Breadcrumb -->
                @yield('breadcrumb')

                <!-- <div class="content">
                    <nav class="breadcrumb mb-0">
                        <a class="breadcrumb-item" href="javascript:void(0)">Inicio</a>
                        <span class="breadcrumb-item active">Dashboard</span>
                    </nav>
                </div> -->
                <!-- END Breadcrumb -->

                <div>
                    <style>
                        #loader {
                            display: none;
                            position: fixed;
                            top: 0;
                            left: 0;
                            right: 0;
                            bottom: 0;
                            width: 100%;
                            background: rgba(0,0,0,0) url("img/loading_pacman.gif") no-repeat center center;
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
        <footer id="page-footer" class="bg-white opacity-0">
            <div class="content py-20 font-size-xs clearfix">
                <div class="float-right">
                    Hecho <img src="{{asset('img/franja_chile.png')}}" alt="">{{-- <i class="fa fa-heart text-pulse"></i> --}} por <a class="font-w600" href="https://intranet.sernatur.cl" target="_blank">TI SERNATUR</a>
                </div>
                <div class="float-left">
                    <a class="font-w600" href="https://1.envato.market/95j" target="_blank">TI 1.0</a> &copy; <span class="js-year-copy"></span>
                </div>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Page Container -->

        <!--
            Codebase JS Core

            Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
            to handle those dependencies through webpack. Please check out assets/_es6/main/bootstrap.js for more info.

            If you like, you could also include them separately directly from the assets/js/core folder in the following
            order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

            assets/js/core/jquery.min.js
            assets/js/core/bootstrap.bundle.min.js
            assets/js/core/simplebar.min.js
            assets/js/core/jquery-scrollLock.min.js
            assets/js/core/jquery.appear.min.js
            assets/js/core/jquery.countTo.min.js
            assets/js/core/js.cookie.min.js
        -->
        <script>
            $(function() {
                $( "form" ).submit(function() {
                    $('#loader').show();
                    /* document.querySelector('#loading').classList.add('loading');
                    document.querySelector('#loading-content').classList.add('loading-content'); */
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
        <script src="{{ asset('assets/js/pages/db_corporate.min.js') }}"></script>
    </body>
    </html>