<?php 
ob_start();
session_start(); 
?>
<?php include("../classes/config.php"); ?>
<?php
if(!isset($_SESSION[SESSION_ADMIN.'_uid'])){
    header('Location: '.$url_site_admin);
}
?>
<?php include("../classes/DB.class.php"); ?>
<?php include("../classes/class.upload.php"); ?>
<?php include("../classes/Geral.class.php"); ?>
<?php include("../classes/CRUD.class.php"); ?>
<?php include("../classes/Menu.class.php"); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo SITE_NAME ?> Admin</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!--base css styles-->
        <link rel="stylesheet" href="<?php echo $url_site_admin ?>assets/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $url_site_admin ?>assets/bootstrap/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="<?php echo $url_site_admin ?>assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $url_site_admin ?>assets/normalize/normalize.css">

        <!--page specific css styles-->
        <link rel="stylesheet" type="text/css" href="<?php echo $url_site_admin ?>assets/data-tables/DT_bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $url_site_admin ?>assets/chosen-bootstrap/chosen.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $url_site_admin ?>assets/jquery-tags-input/jquery.tagsinput.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $url_site_admin ?>assets/bootstrap-fileupload/bootstrap-fileupload.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $url_site_admin ?>assets/bootstrap-colorpicker/css/colorpicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $url_site_admin ?>assets/bootstrap-timepicker/compiled/timepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $url_site_admin ?>assets/clockface/css/clockface.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $url_site_admin ?>assets/bootstrap-datepicker/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $url_site_admin ?>assets/bootstrap-daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $url_site_admin ?>assets/bootstrap-switch/static/stylesheets/bootstrap-switch.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $url_site_admin ?>assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $url_site ?>fonts/icons-extras/font/flaticon.css"> 
        <link rel="stylesheet" href="<?php echo $url_site_admin ?>assets/prettyPhoto/css/prettyPhoto.css">


        <!--flaty css styles-->
        <link rel="stylesheet" href="<?php echo $url_site_admin ?>css/flaty.css">
        <link rel="stylesheet" href="<?php echo $url_site_admin ?>css/flaty-responsive.css">

        <link rel="shortcut icon" href="<?php echo $url_site_admin ?>img/favicon.html">

        <script src="<?php echo $url_site_admin ?>assets/modernizr/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- BEGIN Navbar -->
        <div id="navbar" class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <!-- BEGIN Brand -->
                    <a href="#" class="brand">
                        <small>
                            <i class="icon-desktop"></i>
                            <?php echo SITE_NAME ?> Admin
                        </small>
                    </a>
                    <!-- END Brand -->

                    <!-- BEGIN Responsive Sidebar Collapse -->
                    <a href="#" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-reorder"></i>
                    </a>
                    <!-- END Responsive Sidebar Collapse -->

                    <!-- BEGIN Navbar Buttons -->
                    <ul class="nav flaty-nav pull-right">

                        <!-- BEGIN Button User -->
                        <li class="user-profile">
                            <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                                <span class="hidden-phone" id="user_info">
                                    <?php echo $_SESSION[SESSION_ADMIN.'_nome'] ?>
                                </span>
                                <i class="icon-caret-down"></i>
                            </a>

                            <!-- BEGIN User Dropdown -->
                            <ul class="dropdown-menu dropdown-navbar" id="user_menu">
                                <li>
                                    <a href="<?php echo $url_site_admin ?>sair">
                                        <i class="icon-off"></i>
                                        Sair
                                    </a>
                                </li>
                            </ul>
                            <!-- BEGIN User Dropdown -->
                        </li>
                        <!-- END Button User -->
                    </ul>
                    <!-- END Navbar Buttons -->
                </div><!--/.container-fluid-->
            </div><!--/.navbar-inner-->
        </div>
        <!-- END Navbar -->

        <!-- BEGIN Container -->
        <div class="container-fluid" id="main-container">
            <!-- BEGIN Sidebar -->
            <div id="sidebar" class="nav-collapse">
                <!-- BEGIN Navlist -->

                <!-- BEGIN Sidebar Collapse Button -->
                <div id="sidebar-collapse" class="visible-desktop">
                    <i class="icon-double-angle-left"></i>
                </div>
                <!-- END Sidebar Collapse Button -->
            </div>
            <!-- END Sidebar -->