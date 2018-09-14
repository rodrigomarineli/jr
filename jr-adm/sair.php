<?php 
ob_start();
session_start();
?>
<?php include("../classes/DB.class.php"); ?>
<?php include("../classes/config.php"); ?>
<?php include("../classes/class.upload.php"); ?>
<?php include("../classes/Login.class.php"); ?>

<?php
$sair = Login::sair();
header('Location: '.$url_site);