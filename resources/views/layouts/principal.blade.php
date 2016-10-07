<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PHeventos</title>

        <!-- Bootstrap -->
        <link href="{{url('/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- dataTables -->
        <link href="{{url('/vendors/datatables/jquery.dataTables.min.css')}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{url('/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- iCheck -->
        <link href="{{url('/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="{{url('/build/css/custom.css')}}" rel="stylesheet">

        <!-- Custom Theme Style Principal -->
        <link href="{{url('/build/css/custom_principal.css')}}" rel="stylesheet">

        <!-- jQuery -->
        <script src="{{url('/vendors/jquery/dist/jquery.min.js')}}"></script> 
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col menu_fixed">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="{{url('')}}" class="site_title"><i class="fa fa-calendar"></i> <span>PHeventos</span></a>
                        </div>

                        <div class="clearfix"></div>

                        <br/>

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <!-- <h3>General</h3> -->
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-clone"></i>Categoria  <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                                            <li><a href="fixed_footer.html">Fixed Footer</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{url('/administracao/eventos')}}" ><i class="fa fa-home"></i> Validar certificado <span class="fa fa-chevron-right"></span></a></li>
                                    <li><a href="{{url('/administracao/eventos')}}" ><i class="fa fa-cogs"></i> Administração <span class="fa fa-chevron-right"></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /sidebar menu -->

                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav class="" role="navigation">  
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>
                            <ul class="nav navbar-nav navbar-right">
                                @if (Auth::guest())
                                <li><a href="{{ url('/login') }}">Login</a></li>
                                <li><a href="{{ url('/register') }}">Criar uma conta</a></li>
                                @else
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="images/img.jpg" alt="">{{ Auth::user()->name }}
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a href="javascript:;"> Profile</a></li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="badge bg-red pull-right">50%</span>
                                                <span>Settings</span>
                                            </a>
                                        </li>
                                        <li><a href="javascript:;">Help</a></li>
                                        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                    </ul>
                                </li>
                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge bg-green">6</span>
                                    </a>
                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="text-center">
                                                <a>
                                                    <strong>See All Alerts</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                @endif                  

                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="container">
                        @yield('content') 
                    </div>    


                </div>
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        PHeventos - Sistema gerenciador de eventos by <a href="http://philipealmeida.com.br">Philipe Allan Almeida</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <!-- Bootstrap -->
        <script src="{{url('/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{url('/vendors/fastclick/lib/fastclick.js')}}"></script>
        <!-- dataTables -->
        <script src="{{url('/vendors/datatables/jquery.dataTables.min.js')}}"></script>
        <!-- NProgress -->
        <script src="{{url('/vendors/nprogress/nprogress.js')}}"></script>
        <!-- gauge.js -->
        <script src="{{url('/vendors/bernii/gauge.js/dist/gauge.min.js')}}"></script>
        <!-- bootstrap-progressbar -->
        <script src="{{url('/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
        <!-- iCheck -->
        <script src="{{url('/vendors/iCheck/icheck.min.js')}}"></script>
        <!-- jQuery Mask Plugin -->
        <script src="{{url('/vendors/jquery-mask/dist/jquery.mask.min.js')}}"></script>
        <!-- Custom Theme Scripts -->
        <script src="{{url('/build/js/custom.min.js')}}"></script>

    </body>  
</html>
