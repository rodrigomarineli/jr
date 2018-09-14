<?php
    ob_start();
    session_start();
    include("../classes/config.php");
    include("../classes/DB.class.php");
    include("../classes/Login.class.php");
    if(isset($_SESSION[SESSION_ADMIN.'_uid'])){
        header('Location: list/user');
    }
?>
<!DOCTYPE html>
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Painel Administrativo</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <!--base css styles-->
        <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="assets/bootstrap/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/normalize/normalize.css">

        <!--page specific css styles-->

        <!--flaty css styles-->
        <link rel="stylesheet" href="css/flaty.css">
        <link rel="stylesheet" href="css/flaty-responsive.css">

        <link rel="shortcut icon" href="img/favicon.html">

        <script src="assets/modernizr/modernizr-2.6.2.min.js"></script>
    </head>
    <body class="login-page">
        <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- BEGIN Main Content -->
        <div class="login-wrapper">
            <!-- BEGIN Login Form -->
            <form id="form-login" action="#" method="post">
                <h3>Faça seu Login</h3>
                <hr/>
                <div class="control-group">
                    <div class="controls">
                        <input type="text" placeholder="Usuário" class="input-block-level" name="login" />
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <input type="password" placeholder="Senha" class="input-block-level" name="senha" />
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-primary input-block-level" name="entrar">Entrar</button>
                    </div>
                </div>
                <hr/>
                <?php
                    if(isset($_POST['entrar'])){
                        $logar = Login::logar($_POST['login'],$_POST['senha']);
                        if($logar == true){
                            header('Location: list/user');
                        }
                        else{
                            echo '<p style="color:red;"><strong>Usuário ou senha inválidos</strong></p>';
                        }
                    }
                ?>
            </form>
            <!-- END Login Form -->

        </div>
        <!-- END Main Content -->

        <!--basic scripts-->
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="assets/jquery/jquery-1.10.1.min.js"><\/script>')</script>
        <script src="assets/bootstrap/bootstrap.min.js"></script>

    </body>
</html>
