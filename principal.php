<?php
session_start();
if ($_SESSION['autorizado'] <> 1) {
    header("Location: index.php");
}
$datos_usuario = $_SESSION['datos_usuario'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/favicon.ico" type="image/ico" />

        <title>SGEE-BETAv1 </title>

        <!-- iCheck -->
        <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="build/css/custom.min.css" rel="stylesheet">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="index.html" class="site_title"><i class="fa fa-certificate"></i> <span>SGEE-BETA</span></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="build/images/img.jpg" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Bienvenido,</span>
                                <h2><?php echo $datos_usuario['Nombres']; ?></h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>General</h3>

                                <ul class="nav side-menu">
                                    <?php if ($datos_usuario['nivel'] == '2' || $datos_usuario['nivel'] == '1') {
                                        ?>
                                        <li><a href="javascript:ponerpanel('comprobante.php');"><i class="fa fa-file-text"></i> Comprobantes</a></li>
                                        <li><a href="javascript:ponerpanel('retenciones.php');"><i class="fa fa-chain-broken"></i> Retenciones</a></li>
                                        <li><a href="javascript:ponerpanel('percepciones.php');"><i class="fa fa-clipboard"></i> Percepciones</a></li>
                                        <li><a href="#"><i class="fa fa-files-o"></i> Anulaciones</a></li>
                                        <li><a href="#"><i class="fa fa-align-justify"></i> Resúmenes</a></li>
                                    <?php }?>
                                        
                                    <?php if ($datos_usuario['nivel'] == '1') {
                                        ?>
                                        <li><a href="#"><i class="fa fa-home"></i> Punto de Venta</a></li>
                                        <li><a href="#"><i class="fa fa-cog"></i> Configuración<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <li><a href="javascript:ponerpanel('admin-usuarios.php');"> Usuario</a></li>
                                                <li><a href="#"> Puntos de Venta</a></li>
                                                <li><a href="#"> Otros</a></li>
                                            </ul>
                                        </li>
                                    <?php } ?>



                                </ul>
                            </div>
                        </div>
                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->

                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="build/images/img.jpg" alt=""><?php echo $datos_usuario['Nombres']; ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a href="javascript:;"> Cambiar contraseña</a></li>
                                        <li><a href="cerrarsession.php"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                                    </ul>
                                </li>

                                <!--<li role="presentation" class="dropdown">
                                  
                                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                    <li>
                                      <a>
                                        <span class="image"><img src="build/images/img.jpg" alt="Profile Image" /></span>
                                        <span>
                                          <span>John Smith</span>
                                          <span class="time">3 mins ago</span>
                                        </span>
                                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                        </span>
                                      </a>
                                    </li>
                                    
                                  </ul>
                                </li>-->
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">



                </div>
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">Implementado por <a href="http://brufat.com/">Brufat Company <?= date('Y') ?></a></div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>



        <!-- jQuery -->
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>


        <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>


        <script src="build/js/custom.min.js"></script>
        <script src="build/js/principal.js"></script>

    </body>
</html>
